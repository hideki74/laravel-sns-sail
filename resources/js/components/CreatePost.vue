<template>
<div class="md-form">
  <label>タイトル</label>
  <input type="text" name="title" class="form-control" required value="" v-model="titleInput">
</div>
<div class="form-group">
  <label></label>
  <textarea name="body" required class="form-control" rows="16" placeholder="本文" v-model="bodyInput"></textarea>
</div>
<button type="submit" class="btn blue-gradient btn-block">投稿する</button>
  
<!-- ボタン -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" @click="getDrafts">
  下書き一覧
</button>
<button type="button" class="btn btn-secondary" @click="saveDrafts">
  下書き保存
</button>

<!-- 下書き一覧(モーダル) -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">下書き一覧</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="card" v-for="(draft, index) in drafts" :key="draft.id">
          <div class="card-header d-flex justify-content-between">
              <p>下書き{{ index+1 }}</p>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="card-body d-flex justify-content-between">
            <div class="draft">
              <h5 class="card-title">{{ draft.title }}</h5>
              <p class="card-text">{{ draft.body }}</p>
            </div>
            <div class="ml-auto">
              <a href="#" class="btn btn-primary item">適用</a>
            </div>
          </div>
        </div>
        <p v-if="drafts.length === 0">下書きがありません。</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">戻る</button>
      </div>
    </div>
  </div>
</div>
</template>

<script>
  export default {
    data() {
      return {
        axiosUrl: '/users/' + this.user_name + '/drafts',
        drafts: [],
        titleInput: "",
        bodyInput: "",
      }
    },
    props: {
      user_name: String,
    },
    mounted() {
      // ページ読み込み時に下書き一覧を事前に読み込んでおく
      axios.get(this.axiosUrl).then(res => this.drafts = res.data).catch(e => console.log(e));
    },
    methods: {
      getDrafts() {
        axios.get(this.axiosUrl).then(res => this.drafts = res.data).catch(e => console.log(e));
      },
      saveDrafts() {
        axios.post(this.axiosUrl, {
          // urlにタイトルと本文を送信
          title: this.titleInput,
          body: this.bodyInput,
        }).then(res => {
          // 下書きをセーブしたらタイトルと本文をリセットする
          this.titleInput = "";
          this.bodyInput = "";
        }).catch(e => console.log(e));
      }
    }
  }
</script>

<style scoped>
.card + .card {
  margin-top: 10px;
}

.draft {
  flex: 4 1 0;
  text-align: left;
}

.apply-btn {
  flex: 1 1 0;
  text-align: right;
}
</style>