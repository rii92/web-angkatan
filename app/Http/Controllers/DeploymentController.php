<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\Process\Process;

class DeploymentController extends Controller
{
    /**
     * run deployment script
     *
     * @return void
     */
    public function run(Request $request)
    {
        $output = '';

        try {
            $request->validate([
                'type' => [
                    'required',
                    Rule::in(['pull-repository', 'backup', 'migration', 'clear-cache']),
                ],
            ]);

            $process = new Process([base_path() . "/deploy.sh", $request->input('type'), $request->input('token')]);

            $process->run(function ($type, $line) use (&$output) {
                $output .= $line;
            });

            if ($process->getExitCode()) {
                $output .= $process->getExitCode();
                throw new \Exception($output);
            }

            return response($output, 200);
        } catch (\Exception $e) {
            return response($e->getMessage(), 400);
        }
    }
}
