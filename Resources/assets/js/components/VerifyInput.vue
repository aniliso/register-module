<template>
  <div>
    <div>
      <CodeInput ref="code" :loading="loading" class="codeinput" v-on:change="onChange" :autoFocus="true" v-on:complete="onComplete" :disabled="disabled" />
      <div class="label label-danger message text-center" v-if="message">
        {{ message }}
      </div>
    </div>
    <div class="codeinput send">
      <vac
          ref="sendSMSCode"
          tag="button"
          type="button"
          :autoStart="false"
          :left-time="lifeTime"
          class="btn btn-primary vac text-center"
          @click="sendSMS"
          @finish="(vac) => finish(vac)"
      >
      <span
          slot="process"
          slot-scope="{ timeObj }">
          Kalan Süre : {{ `${timeObj.m}:${timeObj.s}` }}
        </span>
        <span slot-scope="{ state }" v-if="state !== 'process'">{{ buttonTxt }}</span>
      </vac>
    </div>
  </div>
</template>

<script>
import Vue from "vue";
import CodeInput from "vue-verification-code-input";
import axios from "axios";
import vueAwesomeCountdown from 'vue-awesome-countdown';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
Vue.use(vueAwesomeCountdown, 'vac');
const options = {
  confirmButtonText: 'Tamam'
}
Vue.use(VueSweetalert2, options);

export default {
  props: ["redirect", "api", "validate", "lifetime"],
  name: "VerifyInput",
  components: {
    CodeInput
  },
  data() {
    return {
      buttonTxt: 'Doğrulama Kodu Gönder',
      verificationCode: '',
      loading: false,
      lifeTime: 180000,
      disabled: true,
      message: ''
    }
  },
  mounted() {
    this.sendSMS();
  },
  methods: {
    inputLoading() {
      this.loading = false;
    },
    sendSMS() {
      const vm = this;
      const voc = vm.$refs.sendSMSCode;
      const url = this.api;
      voc.attrs.disabled = true;
      vm.buttonTxt = 'Doğrulama Kodu Gönderiliyor';
      let dots = 1;
      let txtLoading = setInterval(() => {
        if (dots > 6) {
          dots = 1;
        }
        vm.buttonTxt = 'Gönderiliyor' + Array.apply(null, {length: dots}).join('.');
        dots++;
      }, 300)
      axios.post(url, { verification: this.verificationCode })
          .then((res) => {
            clearInterval(txtLoading)
            if(res.data.success) {
              this.disabled = false;
              voc.startCountdown('restart')
              return;
            }
            voc.attrs.disabled = false;
            vm.buttonTxt = 'Hatalı Kod Gönderimi';
          })
          .catch(() => {
            clearInterval(txtLoading)
            voc.attrs.disabled = false;
            vm.buttonTxt = 'Sistem Hatası';
          })
    },
    finish(vac) {
      const vm = this;
      this.disabled = true;
      vm.buttonTxt = 'Tekrar Gönder';
      vac.attrs.disabled = false;
    },
    onChange(v) {

    },
    onComplete(v) {
      this.verificationCode = v;
      var redirectUrl = this.redirect;
      this.loading = true;
      axios.post(this.validate, {
        verificationCode : this.verificationCode
        }
      )
      .then(response => {
        this.$swal('Doğrulama tamamlanmıştır.');
        this.loading = true;
        window.location.href = redirectUrl;
      })
      .catch(err => {
        this.$swal('Hatalı doğrulama kodu');
        this.loading = false;
        this.$refs.code.values = ['','','','','',''];
      })
    }
  }
}
</script>

<style scoped>
.codeinput {
  width: auto !important;
  margin-right: 20px;
}
.flex {
  display: inline-flex;
}
.vac {
  margin-top: 20px;
}
</style>