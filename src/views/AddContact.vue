<template>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center">
            <div class="col">
                <h4 class="text-start">
                    <strong>
                        Add Contact
                    </strong>
                </h4>
            </div>
            <router-link to="/" class="col-2 btn btn-primary">
                <i class="fa-solid fa-chevron-left"></i> Back
            </router-link>
        </div>
        <hr class="col-12">

        <!-- Spinner -->
        <div class="container" v-if="loading">
            <Spinner class="col-4 m-auto" />
        </div>

        <!-- Error Message -->
        <div class="container" v-if="errors">
            <div v-for="(field, k) in errors" :key="k" class="alert alert-danger align-items-center text-center col-8 m-auto d-flex mb-2" role="alert">
                <i class="fa-solid fa-triangle-exclamation"></i>&nbsp;&nbsp;&nbsp;
                <div v-for="error in field" :key="error">
                    {{ error }}
                </div>
            </div>
        </div>

        <!-- success message -->
        <div class="container" v-if="status">
            <div class="alert alert-success align-items-center text-center col-8 m-auto d-flex mb-2" role="alert">
                <i class="fa-solid fa-circle-check"></i>&nbsp;&nbsp;&nbsp;
                <div>
                    {{ status.data.message }}
                </div>
            </div>
        </div>

        <!-- Concat Add From -->
        <div class="card col-8 m-auto mt-4" v-if="formShow">
            <div class="card-body">
                <form ref="contact_form" @submit.prevent="submitContact()">
                    <div class="mb-3">
                        <label for="name" class="form-label text-start d-block">Name</label>
                        <input type="text" v-model="contact.name" class="form-control" id="name" placeholder="Example">
                    </div>
                    <div class="mb-3">
                        <label for="email1" class="form-label text-start d-block">Email</label>
                        <input type="email" v-model="contact.email" class="form-control" id="email1" placeholder="example@nail.con">
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label text-start d-block">Photo Url</label>
                        <input type="text" v-model="contact.user_image" class="form-control" id="photo" placeholder="https://example">
                    </div>
                    <div class="mb-3">
                        <label for="number" class="form-label text-start d-block">Number</label>
                        <input type="tel" v-model="contact.number" class="form-control" id="number" placeholder="+88019 ----">
                    </div>
                    <div class="mb-3">
                        <label for="company" class="form-label text-start d-block">Company</label>
                        <input type="text" v-model="contact.company" class="form-control" id="company" placeholder="Example">
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label text-start d-block">Title</label>
                        <input type="text" v-model="contact.title" class="form-control" id="title" placeholder="Example">
                    </div>
                    <div class="mb-3">
                        <label for="group" class="form-label text-start d-block">Title</label>
                        <select class="form-control" v-model="contact.group" id="group" >
                            <option value="" selected>Select Group</option>
                            <option :value="groups.id" v-for="groups of groups.contacts" :key="groups.id" >{{ groups.group }}</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary text-white float-start">Create</button>
                </form>
            </div>
        </div>

    </div>
</template>

<script>

    import axios from 'axios'
    import Spinner from '../components/Spinner'

    export default {
        name: "AddContact",
        components : { Spinner },
        data :function () {
            return {
                contact : {
                    name : '',
                    email : '',
                    user_image : '',
                    number : '',
                    company : '',
                    title : '',
                    group : ''
                 },
                groups: [],
                errors : [],
                status : null,
                loading: false,
                formShow : true,
            }
        },

        created: async function(){
            try {
                const response = await axios.get(process.env.VUE_APP_BASE_URL +'/groups');
                    this.groups = response.data;
            }catch (e) {
                this.error =  e.message
            }
        },
        methods : {
            submitContact : async function(){
                try {
                    this.formShow = false
                    this.loading = true
                    const response = await axios.post(process.env.VUE_APP_BASE_URL +'/contacts/store',this.contact);
                    this.status = response,
                    this.contact.name = null,
                    // Clear All Input Field
                    this.contact.email = null,
                    this.contact.user_image = null,
                    this.contact.number = null,
                    this.contact.company = null,
                    this.contact.title = null,
                    this.contact.group = null,
                    this.contact.name = null,
                    this.contact.name = null,

                    this.loading = false,
                    this.formShow = true
                }catch (e) {
                    if(e.response.status === 422){
                        this.errors = e.response.data.errors
                    }
                    this.loading = false
                    this.formShow = true
                }
            }
        }
    }
</script>

<style scoped>

</style>