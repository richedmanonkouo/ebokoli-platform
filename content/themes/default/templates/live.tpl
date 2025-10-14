
<!-- page content -->
<div class="{if $system['fluid_design']}container-fluid{else}container{/if} mt20 sg-offcanvas">
  <div class="row">


    <!-- content panel -->
<script>
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
</script>
    <!-- content panel -->

  </div>
</div>
<!-- page content -->
