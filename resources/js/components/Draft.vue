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
        <div class="card">
          <div class="card-header d-flex justify-content-between">
              <p>下書き1</p>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="card-body d-flex justify-content-between">
            <div class="draft">
              <h5 class="card-title">タイトル</h5>
              <p class="card-text">本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文</p>
            </div>
            <div class="ml-auto">
              <a href="#" class="btn btn-primary item">適用</a>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header d-flex justify-content-between">
              <p>下書き2</p>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="card-body d-flex justify-content-between">
            <div class="draft">
              <h5 class="card-title">タイトル</h5>
              <p class="card-text">本文本文本文</p>
            </div>
            <div class="apply-btn">
              <a href="#" class="btn btn-primary item">適用</a>
            </div>
          </div>
        </div>
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
        showContent: false
      }
    },
    methods: {
      openModal() {
        this.showContent = true;
      },
      closeModal() {
        this.showContent = false;
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