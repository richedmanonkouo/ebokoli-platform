<?php
/**
 * Convertisseur de devises EUR ↔ XAF
 * Taux fixe (XAF arrimé à l'EUR)
 */

class CurrencyConverter
{
  // Taux fixe EUR/XAF (arrimé)
  const EUR_TO_XAF = 655.957;

  /**
   * Convertir EUR → XAF
   */
  public static function eurToXaf($amount_eur)
  {
    return round($amount_eur * self::EUR_TO_XAF, 2);
  }

  /**
   * Convertir XAF → EUR
   */
  public static function xafToEur($amount_xaf)
  {
    return round($amount_xaf / self::EUR_TO_XAF, 2);
  }

  /**
   * Formater un montant avec le symbole
   */
  public static function format($amount, $currency = 'XAF')
  {
    if ($currency == 'XAF') {
      return number_format($amount, 0, ',', ' ') . ' FCFA';
    } else {
      return number_format($amount, 2, ',', ' ') . ' €';
    }
  }

  /**
   * Obtenir le taux de conversion
   */
  public static function getRate()
  {
    return self::EUR_TO_XAF;
  }
}

// Exemple d'utilisation :
// $montant_xaf = CurrencyConverter::eurToXaf(100); // 100 EUR = 65595.70 XAF
// $montant_eur = CurrencyConverter::xafToEur(65595.70); // 65595.70 XAF = 100 EUR
?>
