<?php

namespace App\Constants;

class ProdiConstant
{
  const KS = 'KOMPUTASI STATISTIK';
  const ST = 'STATISTIKA';
  const D3 = 'D3 STATISTIKA';
  const SI = 'SISTEM INFORMASI';
  const SD = 'SAINS DATA';
  const SE = 'STATISTIKA EKONOMI';
  const SK = 'STATISTIKA KEPENDUDUKAN';


  public static function allProdi()
  {
    return [
      self::KS => self::KS,
      self::ST => self::ST,
      self::D3 => self::D3,
    ];
  }

  public static function allPeminatan()
  {
    return [
      self::SI => self::SI,
      self::SD => self::SD,
      self::SE => self::SE,
      self::SK => self::SK,
    ];
  }
}
