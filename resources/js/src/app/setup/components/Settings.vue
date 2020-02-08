<template>
  <div class="container" v-if="user.authenticated">
    <section class="container m-t-50">
      <div class="columns is-centered">
        <div class="column is-10">
          <div class="card">
            <header class="card-header">
              <p class="card-header-title">Setup Your New Website</p>
            </header>
            <div class="card-content">
              <form action="#" method="post" enctype="multipart/form-data">
                <b-steps type="is-success">
                  <b-step-item :type="errorsSettingsStep" cliclable label="Settings" icon="cog">
                    <b-message
                      type="is-info"
                    >We want you to get started as soon as possible with building your website. So we have made it simple for you! Just add in some details about your page and customize the home, about and contact page.</b-message>

                    <b-field v-bind:message="errorsSettings.name"
                      v-bind:type="errorsSettings.name ? 'is-danger' : ''" label="Site Name" :labelPosition="labelPosition">
                      <b-input required v-model="form.settings.name"></b-input>
                    </b-field>

                    <b-field v-bind:message="errorsSettings.email"
                      v-bind:type="errorsSettings.email ? 'is-danger' : ''" label="E-mail" :labelPosition="labelPosition">
                      <b-input type="email" required v-model="form.settings.email"></b-input>
                    </b-field>

                    <b-field v-bind:message="errorsSettings.description"
                      v-bind:type="errorsSettings.description ? 'is-danger' : ''" label="General Meta Description" :labelPosition="labelPosition">
                      <b-input
                        required
                        minlength="50"
                        maxlength="160"
                        v-model="form.settings.description"
                      ></b-input>
                    </b-field>

                    <p>This field can be left empty. This is for Google analytic tags, external stylesheets, scripts, meta tags, e.t.c.</p>
                    <b-field v-bind:message="errorsSettings.head"
                      v-bind:type="errorsSettings.head ? 'is-danger' : ''" label="HTML Head Code">
                      <codemirror ref="myCm" :v-model="form.settings.head" :options="cmOptions"></codemirror>
                    </b-field>

                    <b-field v-bind:message="errorsSettings.logo"
                      v-bind:type="errorsSettings.logo ? 'is-danger' : ''" class="file">
                      <b-upload drag-drop accept="image/*" v-model="form.settings.logo">
                        <a class="button is-primary">
                          <b-icon icon="upload"></b-icon>
                          <span>Click to upload logo</span>
                        </a>
                      </b-upload>
                      <span class="file-name" v-if="form.settings.logo">{{ form.settings.logo.name }}</span>
                    </b-field>

                    <b-field class="file" v-bind:message="errorsSettings.favicon"
                      v-bind:type="errorsSettings.favicon ? 'is-danger' : ''">
                      <b-upload drag-drop v-model="form.settings.favicon">
                        <a class="button is-primary">
                          <b-icon icon="upload"></b-icon>
                          <span>Click to upload favicon</span>
                        </a>
                      </b-upload>
                      <span
                        class="file-name"
                        v-if="form.settings.favicon"
                      >{{ form.settings.favicon.name }}</span>
                    </b-field>
                  </b-step-item>
                  <b-step-item :type="errorsHomeStep" label="Home" clickable icon="home">
                    <b-field v-bind:message="errorsHome.name"
                      v-bind:type="errorsHome.name ? 'is-danger' : ''" label="Page name" :labelPosition="labelPosition">
                      <b-input v-model="form.home.name" value="Home"></b-input>
                    </b-field>
                    <b-field v-bind:message="errorsHome.displayName"
                      v-bind:type="errorsHome.displayName ? 'is-danger' : ''" label="Display name (in menu)" :labelPosition="labelPosition">
                      <b-input v-model="form.home.displayName" value="Home"></b-input>
                    </b-field>

                    <b-field
                      v-bind:message="errorsHome.description"
                      v-bind:type="errorsHome.description ? 'is-danger' : ''"
                      label="Content"
                      :label-position="labelPosition"
                    >
                      <quill-editor
                        ref="myTextEditor"
                        v-model="form.home.description"
                        :options="editorOption"
                      ></quill-editor>
                    </b-field>

                    <b-field v-bind:message="errorsHome.showArticles"
                      v-bind:type="errorsHome.showArticles ? 'is-danger' : ''" label="Show Articles on home page" :labelPosition="labelPosition">
                      <b-radio-button
                        v-model="form.home.showArticles"
                        native-value="1"
                        type="is-success"
                      >Yes</b-radio-button>

                      <b-radio-button
                        v-model="form.home.showArticles"
                        native-value="0"
                        type="is-danger"
                      >No</b-radio-button>
                    </b-field>

                    <template v-if="form.home.showArticles == true">
                      <b-field v-bind:message="errorsHome.sortBy"
                      v-bind:type="errorsHome.sortBy ? 'is-danger' : ''" label="Sort Articles By" :labelPosition="labelPosition">
                        <b-radio-button
                          v-model="form.home.sortBy"
                          native-value="new"
                          type="is-success"
                        >Newest</b-radio-button>

                        <b-radio-button
                          v-model="form.home.sortBy"
                          native-value="old"
                          type="is-success"
                        >Oldest</b-radio-button>
                      </b-field>

                      <b-field v-bind:message="errorsHome.layout"
                      v-bind:type="errorsHome.layout ? 'is-danger' : ''" label="Layout" :labelPosition="labelPosition">
                        <b-select v-model="form.home.layout" placeholder="Layout for articles">
                          <option value="vertical">Vertical</option>
                          <option value="vertical">Vertical with categories</option>
                          <option value="horizontal">Horizontal</option>
                          <option value="horizontalWithCategories">Horizontal with categories</option>
                          <option value="mix">Mixture of horizontal and vertical</option>
                          <option
                            value="mixWithCategories"
                          >Mixture of horizontal and vertical with categories</option>
                        </b-select>
                      </b-field>
                    </template>

                    <b-field
                      v-bind:message="errorsHome.thumbnail"
                      v-bind:type="errorsHome.thumbnail ? 'is-danger' : ''"
                      class="file"
                    >
                      <b-upload accept="image/*" drag-drop v-model="form.home.thumbnail">
                        <section class="section">
                          <div class="content has-text-centered">
                            <p>
                              <b-icon icon="upload" size="is-large"></b-icon>
                            </p>
                            <p>Drag an image or click the button to upload</p>
                          </div>
                        </section>
                      </b-upload>
                    </b-field>
                    <div class="tags" v-if="form.home.thumbnail">
                      <span class="tag is-primary">
                        {{ form.home.thumbnail.name }}
                      </span>
                    </div>
                  </b-step-item>
                  <b-step-item :type="errorsAboutStep" clickable label="About" icon="address-card">
                    <b-field v-bind:message="errorsAbout.name"
                      v-bind:type="errorsAbout.name ? 'is-danger' : ''" label="Page name" :labelPosition="labelPosition">
                      <b-input v-model="form.about.name" value="Home"></b-input>
                    </b-field>
                    <b-field v-bind:message="errorsAbout.displayName"
                      v-bind:type="errorsAbout.displayName ? 'is-danger' : ''" label="Display name (in menu)" :labelPosition="labelPosition">
                      <b-input v-model="form.about.displayName" value="Home"></b-input>
                    </b-field>

                    <b-field
                      v-bind:message="errorsAbout.description"
                      v-bind:type="errorsAbout.description ? 'is-danger' : ''"
                      label="Content"
                      :label-position="labelPosition"
                    >
                      <quill-editor
                        ref="myTextEditor"
                        v-model="form.about.description"
                        :options="editorOption"
                      ></quill-editor>
                    </b-field>
                    <b-field
                      v-bind:message="errorsAbout.thumbnail"
                      v-bind:type="errorsAbout.thumbnail ? 'is-danger' : ''"
                      class="file"
                    >
                      <b-upload accept="image/*" drag-drop v-model="form.about.thumbnail">
                        <section class="section">
                          <div class="content has-text-centered">
                            <p>
                              <b-icon icon="upload" size="is-large"></b-icon>
                            </p>
                            <p>Drag an image or click the button to upload</p>
                          </div>
                        </section>
                      </b-upload>
                    </b-field>
                    <div class="tags" v-if="form.about.thumbnail">
                      <span class="tag is-primary">
                        {{ form.about.thumbnail.name }}
                      </span>
                    </div>
                  </b-step-item>
                  <b-step-item :type="errorsContactStep" clickable label="Contact" icon="envelope-square">
                    <b-field v-bind:message="errorsContact.name"
                      v-bind:type="errorsContact.name ? 'is-danger' : ''" label="Page name" :labelPosition="labelPosition">
                      <b-input v-model="form.contact.name" value="Home"></b-input>
                    </b-field>
                    <b-field v-bind:message="errorsContact.displayName"
                      v-bind:type="errorsContact.displayName ? 'is-danger' : ''" label="Display name (in menu)" :labelPosition="labelPosition">
                      <b-input v-model="form.contact.displayName" value="Home"></b-input>
                    </b-field>
                    <b-field label="Contact E-mail" :labelPosition="labelPosition">
                      <b-input type="email" v-model="form.contact.email"></b-input>
                    </b-field>

                    <b-field
                      v-bind:message="errorsContact.description"
                      v-bind:type="errorsContact.description ? 'is-danger' : ''"
                      label="Content"
                      :label-position="labelPosition"
                    >
                      <quill-editor
                        ref="myTextEditor"
                        v-model="form.contact.description"
                        :options="editorOption"
                      ></quill-editor>
                    </b-field>
                    <b-field
                      v-bind:message="errorsContact.thumbnail"
                      v-bind:type="errorsContact.thumbnail ? 'is-danger' : ''"
                      class="file"
                    >
                      <b-upload accept="image/*" drag-drop v-model="form.contact.thumbnail">
                        <section class="section">
                          <div class="content has-text-centered">
                            <p>
                              <b-icon icon="upload" size="is-large"></b-icon>
                            </p>
                            <p>Drag an image or click the button to upload</p>
                          </div>
                        </section>
                      </b-upload>
                    </b-field>
                    <div class="tags" v-if="form.contact.thumbnail">
                      <span class="tag is-primary">
                        {{ form.contact.thumbnail.name }}
                      </span>
                    </div>
                  </b-step-item>
                </b-steps>
                <hr />
                <b-button
                      v-on:click.stop="submit"
                      type="is-success"
                    >Send</b-button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import "codemirror/mode/xml/xml";
import "codemirror/addon/selection/active-line.js";
import "codemirror/addon/edit/closetag.js";
import { mapState, mapActions } from "vuex";
export default {
  data() {
    return {
      labelPosition: "on-border",
      errorsHome: [],
      errorsSettings: [],
      errorsAbout: [],
      errorsContact: [],
      errorsSettingsStep: '',
      errorsHomeStep: '',
      errorsAboutStep: '',
      errorsContactStep: '',
      cmOptions: {
        // codemirror options
        title: "",
        description: "",
        tabSize: 4,
        styleActiveLine: true,
        lineNumbers: true,
        autoCloseTags: true,
        line: true,
        mode: "text/html",
        theme: "ambiance"
        // more codemirror options, 更多 codemirror 的高级配置...
      },
      editorOption: {
        modules: {
          toolbar: [
            ["bold", "italic", "underline", "strike"],
            ["blockquote", "code-block"],
            [{ header: 1 }, { header: 2 }],
            [{ list: "ordered" }, { list: "bullet" }],
            [{ script: "sub" }, { script: "super" }],
            [{ indent: "-1" }, { indent: "+1" }],
            [{ direction: "rtl" }],
            [{ size: ["small", false, "large", "huge"] }],
            [{ header: [1, 2, 3, 4, 5, 6, false] }],
            [{ font: [] }],
            [{ color: [] }, { background: [] }],
            [{ align: [] }],
            ["clean"],
            ["link", "image", "video"]
          ],
          syntax: {
            highlight: text => hljs.highlightAuto(text).value
          }
        }
      },
      form: {
        settings: {
          name: "",
          email: "",
          description: "",
          logo: null,
          favicon: null,
          showUnderCounstrion: false,
          head: ``
        },
        home: {
          name: "Home",
          displayName: "Home",
          sortBy: "new",
          layout: "vertical",
          thumbnail: null,
          showArticles: null,
          description: ``
        },
        about: {
          name: "About",
          displayName: "About",
          description: ``,
          thumbnail: null
        },
        contact: {
          name: "Contact",
          displayName: "Contact",
          description: ``,
          email: "",
          thumbnail: null
        }
      }
    };
  },
  computed: mapState({
    user: state => state.auth.user
  }),
  methods: {
    ...mapActions({
      addSettings: "setup/addSettings",
      addHome: "setup/addHome",
      addAbout: "setup/addAbout",
      addContact: "setup/addContact"
    }),
    submit() {
      this.addSettings({
        payload: {
          name: this.form.settings.name,
          email: this.form.settings.email,
          description: this.form.settings.description,
          logo: this.form.settings.logo,
          favicon: this.form.settings.favicon,
          head: this.form.settings.head,
          showUnderCounstrion: this.form.settings.showUnderCounstrion
        },
        context: this
      }).then(() => {
        
      });

      this.addHome({
        payload: {
          name: this.form.home.name,
          displayName: this.form.home.displayName,
          sortBy: this.form.home.sortBy,
          layout: this.form.home.layout,
          thumbnail: this.form.home.thumbnail,
          showArticles: this.form.home.showArticles,
          description: this.form.home.description
        },
        context: this
      }).then(() => {
        
      });

      this.addAbout({
        payload: {
          name: this.form.about.name,
          displayName: this.form.about.displayName,
          thumbnail: this.form.about.thumbnail,
          description: this.form.about.description
        },
        context: this
      }).then(() => {
        
      });

      this.addContact({
        payload: {
          name: this.form.contact.name,
          displayName: this.form.contact.displayName,
          thumbnail: this.form.contact.thumbnail,
          description: this.form.contact.description,
          email: this.form.contact.email
        },
        context: this
      }).then(() => {
        
      });
    },
    codemirror() {
      return this.$refs.myCm.codemirror;
    }
  }
};
</script>