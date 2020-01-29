<template>
  <div class="container">
    <div class="columns">
      <div class="column is-2">
        <AdminMenu />
      </div>
      <div class="column is-10">
        <div class="box m-t-50">
          <b-field label="Title" :label-position="labelPosition">
            <b-input v-model="title" placeholder="Site Title"></b-input>
          </b-field>
          <b-field
            label="Meta Description (only used if no description is found)"
            :label-position="labelPosition"
          >
            <b-input v-model="description" placeholder="Description"></b-input>
          </b-field>

          <b-field label="HTML Head Code">
            <codemirror ref="myCm" :value="code" :options="cmOptions"></codemirror>
          </b-field>

          <hr />
          <br />
          <b-field>
            <b-button
              v-if="this.title && this.description"
              v-on:click.stop="submit"
              type="is-success"
            >Send</b-button>
            <b-button
              v-if="!this.description || !this.title"
              disabled
              type="is-danger"
            >
              Please
              fill in all the forms
            </b-button>
          </b-field>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import "codemirror/mode/xml/xml";
// require active-line.js
import "codemirror/addon/selection/active-line.js";
// autoCloseTags
import "codemirror/addon/edit/closetag.js";
export default {
  data() {
    return {
      labelPosition: "on-border",
      code: `//Google analytic tag`,
      cmOptions: {
        // codemirror options
        title: '',
        description: '',
        tabSize: 4,
        styleActiveLine: true,
        lineNumbers: true,
        autoCloseTags: true,
        line: true,
        mode: "text/html",
        theme: "ambiance"
        // more codemirror options, 更多 codemirror 的高级配置...
      }
    };
  },
  methods: {},
  computed: {
    codemirror() {
      return this.$refs.myCm.codemirror;
    }
  },
  mounted() {}
};
</script>