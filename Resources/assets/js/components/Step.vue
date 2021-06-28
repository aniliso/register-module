<template>
  <form-wizard>
    <tab-content title="About You" :selected="true">
      <div class="form-group">
        <label for="fullName">Full Name</label>
        <input type="text" class="form-control" placeholder="Enter your name" v-model="fullName">
      </div>
    </tab-content>
    <tab-content title="About your Company">
      <div class="form-group">
        <label for="companyName">Your Company Name</label>
        <input type="text" class="form-control" placeholder="Enter your Company / Organization name" v-model="companyName">
      </div>
    </tab-content>
    <tab-content title="Finishing Up">
      <div class="form-group">
        <label for="referral">From Where did you hear about us</label>
        <select class="form-control" v-model="referral">
          <option>Newspaper</option>
          <option>Online Ad</option>
          <option>Friend</option>
          <option>Other</option>
        </select>
      </div>
    </tab-content>
  </form-wizard>
</template>

<script>
import {FormWizard, TabContent} from 'vue-step-wizard'
import "vue-step-wizard/dist/vue-step-wizard.css";


export default {
  name: 'step-form',
  components: {
    FormWizard,
    TabContent
  },
  data(){
    return {
      fullName: '',
      companyName: '',
      referral: '',
    }
  },
}
</script>