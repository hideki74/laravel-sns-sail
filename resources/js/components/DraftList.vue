<template>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  下書き一覧
</button>

<!-- Modal -->
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
        drafts: [],
      }
    },
    props: {
      user_name: String,
    },
    mounted() {
      // ユーザーごとの下書きを取るURLを作成
      let url = '/users/' + this.user_name + '/drafts';
      axios.post(url).then(response => this.drafts = response.data).catch(e => console.log(e));
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