<template>
  <div>
    <a v-on:click="showPage">{{ title }}</a> {{ subtitle }}
    <div class="modal-mask" v-if="showModal" v-on:close="showModal = false">
      <div class="modal-wrapper">
        <div class="modal-container">
          <div class="modal-header">
            <h3 class="theme-txt-color">{{ showTitle }}</h3>
          </div>
          <div class="modal-body" v-html="showHtml">
          </div>
          <div class="modal-footer">
            <slot name="footer">
              <button class="btn btn-primary modal-default-button" v-on:click="closeWindow">
                Okudum ve Anladım
              </button>
            </slot>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

export default {
  name: "Modal",
  props: ["api", "title", "pageid", "subtitle"],
  data() {
    return {
      showModal: false,
      showHtml: "",
      showTitle: ""
    }
  },
  methods: {
    showPage() {
      this.showModal = true;
      this.showTitle = "Yükleniyor...";
      this.showHtml = "Yükleniyor...";
      axios.get(this.api + '?page_id=' + this.pageid)
    .then(response => {
        this.showHtml = response.data.data.body;
        this.showTitle = response.data.data.title;
      })
    },
    closeWindow() {
      this.showModal = false;
    }
  }
}
</script>

<style scoped>
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: table;
  transition: opacity 0.3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-container {
  max-width: 800px;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
  transition: all 0.3s ease;
  font-family: Helvetica, Arial, sans-serif;
}

.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}

.modal-body {
  margin: 20px 0;
  height: 500px;
  overflow: auto;
}

.modal-default-button {
  float: right;
}

/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}

</style>