/**
 * Wallet Savings & Loans JavaScript
 *
 * @package Sngine
 * @author Extension EBOKOLI
 */

// Withdraw Saving
$('body').on('click', '.js_wallet-withdraw-saving', function() {
  var saving_id = $(this).data('id');

  confirm(__("Retirer l'épargne"), __("Êtes-vous sûr de vouloir retirer cette épargne? Le montant plus les intérêts seront ajoutés à votre solde wallet."), function() {
    $.post('includes/ajax/core/wallet_savings.php?do=withdraw', {saving_id: saving_id}, function(response) {
      if (response.callback) {
        eval(response.callback);
      }
    }, 'json').fail(function() {
      alert(__("Erreur"), __("Une erreur s'est produite. Veuillez réessayer."));
    });
  });
});

// Pay Loan
$('body').on('click', '.js_wallet-pay-loan', function() {
  var loan_id = $(this).data('id');

  // Open modal for payment amount
  modal('#pay-loan-modal', 'includes/ajax/wallet/pay_loan.php?loan_id=' + loan_id);
});

// =============================================================
// TEMPS RÉEL - Auto-refresh des données Wallet
// =============================================================

var walletAutoRefreshEnabled = true;
var walletRefreshInterval = 30000; // 30 secondes
var walletRefreshTimer = null;
var walletLastData = null;

// Détecter quelle vue du wallet est active
function getWalletView() {
  if ($('.page-content').closest('[data-view="savings"]').length > 0) {
    return 'savings';
  } else if ($('.page-content').closest('[data-view="loans"]').length > 0) {
    return 'loans';
  } else {
    return 'wallet';
  }
}

// Vérifier si on est sur la page wallet
function isWalletPage() {
  return current_page === 'wallet';
}

// Afficher notification de mise à jour
function showWalletUpdateNotification() {
  // Créer un badge de notification si pas déjà présent
  if ($('#wallet-update-notification').length === 0) {
    var notificationHtml = '<div id="wallet-update-notification" style="position: fixed; top: 70px; right: 20px; z-index: 9999; display: none;">' +
      '<div class="alert alert-info alert-dismissible fade show" role="alert" style="box-shadow: 0 4px 12px rgba(0,0,0,0.15);">' +
      '<strong><i class="fa fa-sync-alt fa-spin mr-2"></i>Nouvelles données disponibles!</strong><br>' +
      '<small>Vos épargnes ou emprunts ont été mis à jour par l\'administrateur.</small>' +
      '<button type="button" class="btn btn-sm btn-primary ml-3" onclick="refreshWalletData(true)">Rafraîchir maintenant</button>' +
      '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
      '<span aria-hidden="true">&times;</span>' +
      '</button>' +
      '</div>' +
      '</div>';
    $('body').append(notificationHtml);
  }

  $('#wallet-update-notification').fadeIn();

  // Auto-hide après 10 secondes
  setTimeout(function() {
    $('#wallet-update-notification').fadeOut();
  }, 10000);
}

// Comparer les données pour détecter les changements
function hasWalletDataChanged(newData) {
  if (!walletLastData) {
    walletLastData = newData;
    return false;
  }

  var changed = JSON.stringify(walletLastData) !== JSON.stringify(newData);

  if (changed) {
    walletLastData = newData;
  }

  return changed;
}

// Rafraîchir les données du wallet
function refreshWalletData(forceReload) {
  if (!isWalletPage() || !walletAutoRefreshEnabled) {
    return;
  }

  var view = getWalletView();

  $.ajax({
    url: site_path + '/includes/ajax/wallet/get_wallet_data.php',
    type: 'GET',
    data: { view: view },
    dataType: 'json',
    success: function(response) {
      if (response.success) {
        // Vérifier si les données ont changé
        if (hasWalletDataChanged(response)) {
          if (forceReload === true) {
            // Recharger la page immédiatement
            location.reload();
          } else {
            // Afficher notification
            showWalletUpdateNotification();
          }
        }
      }
    },
    error: function() {
      console.log('Wallet auto-refresh: Erreur lors de la récupération des données');
    }
  });
}

// Exposer la fonction globalement pour le bouton
window.refreshWalletData = refreshWalletData;

// Démarrer l'auto-refresh
function startWalletAutoRefresh() {
  if (isWalletPage() && walletAutoRefreshEnabled) {
    // Rafraîchir immédiatement au chargement
    setTimeout(function() {
      refreshWalletData(false);
    }, 2000);

    // Puis toutes les 30 secondes
    walletRefreshTimer = setInterval(function() {
      refreshWalletData(false);
    }, walletRefreshInterval);

    console.log('Wallet auto-refresh activé (toutes les ' + (walletRefreshInterval/1000) + ' secondes)');
  }
}

// Arrêter l'auto-refresh
function stopWalletAutoRefresh() {
  if (walletRefreshTimer) {
    clearInterval(walletRefreshTimer);
    walletRefreshTimer = null;
    console.log('Wallet auto-refresh désactivé');
  }
}

// Ajouter un bouton de rafraîchissement manuel (optionnel)
function addManualRefreshButton() {
  if (isWalletPage() && $('.wallet-manual-refresh').length === 0) {
    var refreshBtn = '<button class="btn btn-sm btn-light wallet-manual-refresh" onclick="refreshWalletData(true)" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000; box-shadow: 0 2px 8px rgba(0,0,0,0.2);" title="Rafraîchir les données">' +
      '<i class="fa fa-sync-alt"></i> Rafraîchir' +
      '</button>';
    $('body').append(refreshBtn);
  }
}

// Initialisation
$(document).ready(function() {
  // These handlers are already managed by the existing Sngine modal system
  // via data-toggle="modal" and data-url attributes in wallet.tpl

  // Démarrer l'auto-refresh si on est sur la page wallet
  if (isWalletPage()) {
    startWalletAutoRefresh();
    addManualRefreshButton();
  }
});

// Arrêter l'auto-refresh quand on quitte la page
$(window).on('beforeunload', function() {
  stopWalletAutoRefresh();
});
