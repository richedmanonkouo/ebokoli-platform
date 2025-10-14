<?php
/* Smarty version 4.3.4, created on 2024-03-22 17:25:30
  from '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/live.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65fdbf0a8ec293_86602426',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7a84a2dc31c4f8dd9d2e016343b82d637ae208f6' => 
    array (
      0 => '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/live.tpl',
      1 => 1711128083,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65fdbf0a8ec293_86602426 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!-- page content -->
<div class="<?php if ($_smarty_tpl->tpl_vars['system']->value['fluid_design']) {?>container-fluid<?php } else { ?>container<?php }?> mt20 sg-offcanvas">
  <div class="row">


    <!-- content panel -->
<?php echo '<script'; ?>
>
  var script = document.createElement("script");
  script.type = "text/javascript";

  script.addEventListener("load", function (event) {
    const config = {
      name: "Demo User",
      meetingId: "milkyway",
      apiKey: "8e89676a-f6f2-44a3-be2d-e16b4e9435fa",

      containerId: null,
      debug: true,
      micEnabled: true,
      webcamEnabled: true,
      participantCanToggleSelfWebcam: true,
      participantCanToggleSelfMic: true,
      whiteboardEnabled: true,

      chatEnabled: true,
      raiseHandEnabled: true,
      screenShareEnabled: true,
      maxResolution: "sd", 
      participantCanLeave: true,
      redirectOnLeave: "https://ebokoli.com",

      joinScreen: {
      visible: true,
      title: "Salle Ebokli",
      meetingUrl: "customURL.com",

      },
      permissions: {
        pin: true,
        removeParticipant: true,
        endMeeting: true,
        askToJoin: false,
        toggleParticipantWebcam: false,
        toggleParticipantMic: false,
        toggleParticipantScreenshare: false,
        drawOnWhiteboard: true,
        toggleWhiteboard: true,
      },

      leftScreen: {
        actionButton: {
          label: "Ebokoli",
          href: "https://ebokoli.com",
        },
        rejoinButtonEnabled: true,
      },

      layout: {
          type: "SIDEBAR", // "SPOTLIGHT" | "SIDEBAR" | "GRID"
          priority: "PIN", // "SPEAKER" | "PIN",
          gridSize: 3,
        },
      waitingScreen: {
        imageUrl: "",
        text: "Connection à la salle...",
      },
      branding: {
        enabled: true,
        logoURL:
          "images/3.png",
        name: "Salle Ebokoli",
        poweredBy: false,
      },
      videoConfig: {
        resolution: "h720p_w1280p", //h360p_w640p, h540p_w960p, h1080p_w1920p
        optimizationMode: "motion", // text , detail
        multiStream: true,
      },

    };

    const meeting = new VideoSDKMeeting();
    meeting.init(config);
  });

  script.src =
    "https://sdk.videosdk.live/rtc-js-prebuilt/0.3.37/rtc-js-prebuilt.js";
  document.getElementsByTagName("head")[0].appendChild(script);
<?php echo '</script'; ?>
>
    <!-- content panel -->

  </div>
</div>
<!-- page content -->
<?php }
}
