<template>
  <button type="button" class="btn m-0 p-1 shadow-none">
      <i class="fas fa-bookmark mr-1"
      :class="{'blue-text':this.isBookmarkedBy, 'animated tada':this.gotToBookmark}"
      @click="clickBookmark"
      ></i>
      {{ countBookmarks }}
  </button>
</template>

<script>
export default {
    props: {
        initialIsBookmarkedBy: {
            type: Boolean,
            default: false,
        },
        initialCountBookmarks: {
            type: Number,
            default: 0,
        },
        authorized: {
            type: Boolean,
            default: false,
        },
        endpoint: {
            type: String,
        }
    },
    data() {
        return {
            isBookmarkedBy: this.initialIsBookmarkedBy,
            countBookmarks: this.initialCountBookmarks,
            gotToBookmark: false,
        }
    },
    methods: {
        clickBookmark() {
            if(!this.authorized) {
                alert('ブックマーク機能はログイン中のみ使用できます');
                return;
            }

            this.isBookmarkedBy ? this.unBookmark() : this.bookmark();
        },

        async bookmark() {
            const response = await axios.put(this.endpoint);
            this.isBookmarkedBy = true;
            this.countBookmarks = response.data.countBookmarks;
            this.gotToBookmark = true;
        },

        async unBookmark() {
            const response = await axios.delete(this.endpoint);
            this.isBookmarkedBy = false;
            this.countBookmarks = response.data.countBookmarks;
            this.gotToBookmark = false;
        },
    },
}
</script>