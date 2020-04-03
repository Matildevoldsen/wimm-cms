<template>
    <div class="container" style="background: white;">
        <div class="box" style="margin-top: 20px;">
            <h1 class="title">Configure your new website</h1>

            <form>
                <b-steps v-model="steps.activeStep"
                         :animated="steps.isAnimated"
                         :has-navigation="steps.hasNavigation"
                         :icon-prev="steps.prevIcon"
                         :icon-next="steps.nextIcon">
                    <b-step-item label="Site Configuration" icon="server" :clickable="isStepsClickable">
                        <b-field label="Website Name" >
                            <b-input v-model="form.name" focus placeholder="Cooking Receipts" maxlength="100"></b-input>
                        </b-field>

                        <b-field label="Describe your website">
                            <b-input v-model="form.description" placeholder="General site description used if no other description is given."
                                     maxlength="250"></b-input>
                        </b-field>

                        <b-field label="Admin E-mail">
                            <b-input v-model="form.email" focus placeholder="Please enter the admin E-mail address" type="email"></b-input>
                        </b-field>

                        <b-field label="What database driver will you use?">
                            <b-switch type="is-info" v-model="form.isSwitchedCustom"
                                      true-value="Other"
                                      false-value="SQLite">
                                {{ form.isSwitchedCustom }}
                            </b-switch>
                        </b-field>

                        <b-message v-if="form.isSwitchedCustom == 'SQLite'" title="Warning" type="is-warning"
                                   aria-close-label="Close message">
                            SQLite is not meant for applications storing a large amount of data. If you know or
                            expect your site to contain lots of articles, pages, e.t.c. please use MySQL
                        </b-message>

                        <template v-if="form.isSwitchedCustom == 'Other'">
                            <p>Please enter your driver settings</p>

                            <b-field label="Driver">
                                <b-select v-model="form.db.driver" placeholder="Please select a driver">
                                    <option selected value="mysql">MySQL</option>
                                    <option value="PostgreSQL">PostgreSQL</option>
                                </b-select>
                            </b-field>

                            <b-field label="Host">
                                <b-input v-model="form.db.host" placeholder="E.g. 127.0.0.1"></b-input>
                            </b-field>

                            <b-field label="Port">
                                <b-input v-model="form.db.port" placeholder="E.g. 127.0.0.1"></b-input>
                            </b-field>

                            <b-field label="Database Name">
                                <b-input v-model="form.db.db" placeholder="E.g. 127.0.0.1"></b-input>
                            </b-field>

                            <b-field label="Username">
                                <b-input v-model="form.db.username" placeholder="E.g. root"></b-input>
                            </b-field>

                            <b-field label="Password">
                                <b-input v-model="form.db.password" placeholder="Please enter your database password"
                                         type="password"></b-input>
                            </b-field>

                            <b-button v-on:click="testDB">Test Connection</b-button>
                        </template>
                    </b-step-item>
                    <b-step-item label="E-mail configuration" icon="user" :clickable="steps.isStepsClickable">
                        <h2 class="title">E-mail Configuration</h2>
                        <p>Please provide us with your E-mail settings in order for your website to send emails to users.</p>
                        <b-field label="E-mail Driver">
                            <b-input focus placeholder="Please enter the admin E-mail address"></b-input>
                        </b-field>

                        <b-field label="Host">
                            <b-input focus placeholder="Please enter the admin E-mail address"></b-input>
                        </b-field>

                        <b-field label="Port">
                            <b-input focus placeholder="Please enter the admin E-mail address"></b-input>
                        </b-field>

                        <b-field label="Username">
                            <b-input focus placeholder="Please enter the admin E-mail address" ></b-input>
                        </b-field>

                        <b-field label="Password">
                            <b-input type="password" focus placeholder="Please enter the admin E-mail address"></b-input>
                        </b-field>
                    </b-step-item>

                    </b-step-item>
                    <template
                            v-if="steps.customNavigation"
                            slot="navigation"
                            slot-scope="{previous, next}">
                        <b-button
                                outlined
                                type="is-danger"
                                icon-pack="fas"
                                icon-left="backward"
                                :disabled="previous.disabled"
                                @click.prevent="previous.action">
                            Previous
                        </b-button>
                        <b-button
                                v-if="form.isSwitchedCustom == 'SQLite' && steps.activeStep === 0"
                                outlined
                                type="is-success"
                                icon-pack="fas"
                                icon-right="forward"
                                @click.prevent="next.action">
                            Next
                        </b-button>
                        <b-button
                                v-if="form.isSwitchedCustom == 'Other' && steps.activeStep === 0"
                                outlined
                                type="is-success"
                                icon-pack="fas"
                                icon-right="forward"
                                :disabled="steps.nextDisabled"
                                @click.prevent="next.action">
                            Next
                        </b-button>
                        <b-button
                                v-if="steps.activeStep === 1"
                                type="is-success">
                            Finish
                        </b-button>
                    </template>
                </b-steps>
            </form>
        </div>
    </div>
</template>
<script>
    import {
        setHttpToken
    } from '../../../../../helpers'
    import Axios from 'axios'
    import FormData from 'form-data'

    export default {
        data() {
            return {
                steps: {
                    nextDisabled: true,
                    activeStep: 0,
                    showSocial: false,
                    isAnimated: true,
                    hasNavigation: true,
                    customNavigation: true,
                    prevIcon: 'chevron-left',
                    nextIcon: 'chevron-right',
                    isStepsClickable: false,
                    isProfileSuccess: false,
                },
                form: {
                    name: '',
                    description: '',
                    email: '',
                    db: {
                        host: '',
                        port: '',
                        driver: 'SQLite',
                        db: '',
                        username: '',
                        password: ''
                    },
                    emailConfig: {
                        driver: '',
                        host: '',
                        port: '',
                        username: '',
                        password: ''
                    },
                    isSwitchedCustom: 'SQLite'
                }
            }
        },
        mounted() {
            this.form.name = window.wimm.settings.name
        },
        methods: {
            testDB() {
                let data = new FormData()
                data.append('host', this.form.db.host)
                data.append('name', this.form.name)
                data.append('driver', this.form.db.driver)
                data.append('port', this.form.db.port)
                data.append('username', this.form.db.username)
                data.append('db', this.form.db.db)
                data.append('password', this.form.db.password)

                Axios.post('127.0.0.1:8000' + '/api/testDB', data).then((res) => {
                    console.log(res)
                });
            }
        }
    }
</script>
<style>
    body {
        background: #fff;
    }
</style>