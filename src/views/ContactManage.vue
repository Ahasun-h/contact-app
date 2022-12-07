<template>
    <div class="container py-4">
       <div class="d-flex justify-content-between align-items-center">
           <div class="col">
               <h4 class="text-start">
                   <strong>
                       Contact Manager
                   </strong>
               </h4>
           </div>
           <router-link to="/add" class="col-2 btn btn-success">
               <i class="fa-solid fa-plus"></i> Add Contact
           </router-link>
       </div>
       <hr class="col-12">
       <p class="text-start">
            <i>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
            </i>
       </p>
       <from class="input-group search-input-group m-auto">
           <input type="text" class="form-control" placeholder="Search Contact" aria-label="Input group example" aria-describedby="btnGroupAddon">
           <button type="submit" class="input-group-text bg-success text-white" id="btnGroupAddon"><i class="fa-solid fa-magnifying-glass"></i>&nbsp;Search</button>
       </from>
   </div>

    <!-- Spinner -->
    <div class="container" v-if="loading">
        <Spinner class="col-4 m-auto" />
    </div>

    <!-- Error Message -->
    <div class="container" v-if="error !== null">
        <div class="alert alert-danger align-items-center text-center col-6 m-auto" role="alert">
            <i class="fa-solid fa-triangle-exclamation"></i>&nbsp;&nbsp;&nbsp;
            <div>
                {{ error }}
            </div>
        </div>
    </div>



    <div class="container">
        <div class="row">
            <div class="col-6 mb-4" v-for="contact in contacts.contacts" :key="contact.id">
                <div class="card h-100 shadow-lg" >
                    <div class="card-body row align-items-center">
                        <img class="col-4" :src="contact.user_image"/>
                        <div class="col-8">
                            <h6 class="card-title text-start">
                                <strong>Name : {{ contact.name }}</strong>
                            </h6>
                            <h6 class="card-title text-start">
                                <strong>
                                    Email : {{ contact.email }}
                                </strong>
                            </h6>
                            <h6 class="card-title text-start">
                                <strong>
                                    Phone : {{ contact.number }}
                                </strong>

                            </h6>
                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <router-link :to="{name: 'ViewContact' , params:{ id: contact.id }}"
                                         class="btn btn-warning">
                                <i class="fa-solid fa-eye"></i> View
                            </router-link>
                            <router-link :to="{name: 'EditContact' , params:{ id: contact.id }}"
                                         class="btn btn-primary text-white">
                                <i class="fa-regular fa-pen-to-square"></i> Edit
                            </router-link>
                            <button type="button" class="btn btn-danger text-white" @click="deleteContact(contact.id)">
                                <i class="fa-regular fa-trash-can"></i> Delete
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</template>

<script>

    import Spinner from '../components/Spinner'
    import axios from 'axios'



    export default {
        name: "ContactManage",
        components : {Spinner},
        data :function () {
            return {
                loading: false,
                contacts: [],
                error : null,
            }
        },

        created: async function(){
            try {
                this.loading = true;
                const response = await axios.get(process.env.VUE_APP_BASE_URL +'/contacts');
                this.loading = false,
                this.contacts = response.data;
            }catch (e) {
                this.error =  e.message,
                this.loading = false
            }
        },
        methods:{
            deleteContact: async function(id){
                try {
                    const response = await axios.delete(process.env.VUE_APP_BASE_URL +'/contact/delete/'+id);
                    if(response){
                        const response = await axios.get(process.env.VUE_APP_BASE_URL +'/contacts');
                        this.contacts = response.data;
                    }
                }
                catch (e) {
                    this.error =  e.message
                }
            }
        }
    }


</script>

<style scoped>
    .search-input-group{
        width: 50%;
    }


</style>