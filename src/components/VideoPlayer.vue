<template>
  <div>
    <video ref="videoPlayer" class="video-js"></video>
  </div>
</template>

<script>
import 'video.js/dist/video-js.css'
import videojs from 'video.js';

export default {
  name: 'VideoPlayer',
  props: {
    video: {
      type: String,
    }
  },
  data() {
    return {
      player: null,
      options: {
        autoplay: true,
        controls: true,
        fluid: true,
        aspectRatio: "9:16",
        sources: [
          {
            src:
              this.video,
              type: 'video/mp4'
          }
        ]
      }
    }
  },
  mounted() {
    this.player = videojs(this.$refs.videoPlayer, this.options, () => {
      this.player.log('onPlayerReady', this);
    });
  },
  beforeDestroy() {
    if (this.player) {
      this.player.dispose();
    }
  },
}
</script>