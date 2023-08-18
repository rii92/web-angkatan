<?php

namespace Database\Factories;

use App\Constants\AppKonsul;
use App\Constants\AppRoles;
use App\Models\Konsul;
use App\Models\KonsulChat;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class KonsulFactory extends Factory
{
    protected $model = Konsul::class;

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Konsul $konsul) {

            $admin = User::role($konsul->category == AppKonsul::TYPE_AKADEMIK ? AppRoles::AKADEMIK : AppRoles::HUMAS)->inRandomOrder()->first();

            $konsul->name = $konsul->is_anonim ? 'Anonim_' . $konsul->id : $konsul->user->name;

            Tag::inRandomOrder()
                ->limit(rand(1, 5))
                ->get()
                ->each(fn ($tag) => $konsul->tags()->save($tag));

            if (in_array($konsul->status, [AppKonsul::STATUS_PROGRESS, AppKonsul::STATUS_DONE])) {
                $lastUpdate = KonsulChat::factory(rand(10, 30))
                    ->make(['konsul_id' => $konsul->id])
                    ->each(fn ($chat) => $chat->user_id = $chat->is_admin ? $admin->id : $konsul->user->id)
                    ->sortBy('created_at')
                    ->each(fn ($chat) => $konsul->chats()->save($chat))
                    ->last()->created_at;

                if ($konsul->status == AppKonsul::STATUS_DONE) $lastUpdate = $konsul->is_publish ? $konsul->published_at : $konsul->done_at;
            } else {
                $lastUpdate = $konsul->status == AppKonsul::STATUS_WAIT ? $konsul->created_at : $konsul->acc_rej_at;
            }

            $konsul->updated_at = $lastUpdate;

            $konsul->save();
        });
    }


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status = $this->faker->randomElement(AppKonsul::allStatus());

        $created_at = $this->faker->dateTimeBetween('-50 days', '-20 days');

        $title = $this->faker->sentence(rand(10, 20));

        $user = User::role(AppRoles::USERS)->has('details')->inRandomOrder()->first();

        if ($status != AppKonsul::STATUS_WAIT) {
            $accepted_at = $this->faker->dateTimeBetween($created_at, '-3 days');

            if ($status == AppKonsul::STATUS_REJECT) $note = $this->faker->paragraph(rand(7, 15));

            if ($status != AppKonsul::STATUS_REJECT && $status != AppKonsul::STATUS_PROGRESS) {
                $done_at = $this->faker->dateTimeBetween($accepted_at, '-1 days');

                $isPublish = $this->faker->boolean();

                if ($isPublish) {
                    $published_at = $this->faker->dateTimeBetween($done_at);

                    $randomInt = $this->faker->numerify(' #####');

                    $slug = Str::slug(Str::limit($title, 60, '') . $randomInt);
                }
            }
        }

        return [
            'title' => $title,
            'user_id' => $user->id,
            'category' => $this->faker->randomElement([AppKonsul::TYPE_AKADEMIK, AppKonsul::TYPE_UMUM]),
            'status' => $status,
            'is_anonim' => $this->faker->boolean(),
            'description' => $this->faker->paragraph(rand(7, 15)),
            'created_at' => $created_at,
            'acc_rej_at' => $accepted_at ?? null,
            'done_at' => $done_at ?? null,
            'published_at' => $published_at ?? null,
            'note' => $note ?? null,
            'slug' => $slug ?? null,
            'acc_publish_admin' => $isPublish ?? false,
            'acc_publish_user' => $isPublish ?? false
        ];
    }
}
