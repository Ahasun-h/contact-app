<template>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center">
            <div class="col">
                <h4 class="text-start">
                    <strong>
                        View Contact
                    </strong>
                </h4>
            </div>
            <router-link to="/contacts" class="col-2 btn btn-success">
                <i class="fa-solid fa-list-check"></i> List Contacts
            </router-link>
        </div>
        <hr class="col-12">
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

    <div class="container py-4" v-if="!loading">
        <div class="row">
            <div class="col-12">
                <div class="card h-100 shadow-lg">
                    <div class="card-header">
                        <router-link to='/' class="btn btn-success back-button" >
                            <i class="fa-solid fa-chevron-left"></i> Back
                        </router-link>
                    </div>
                    <div class="card-body row align-items-center">
                        <img class="col-4" :src="contactData.user_image"  />
                        <div class="col-8 pl-4">
                            <h6 class="card-title text-start">
                                <strong>
                                    Name : {{ contactData.name }}
                                </strong>
                            </h6>
                            <h6 class="card-title text-start">
                                <strong>
                                    Email : {{ contactData.email }}
                                </strong>
                            </h6>
                            <h6 class="card-title text-start">
                                <strong>
                                    Phone : {{ contactData.number }}
                                </strong>

                            </h6>
                            <h6 class="card-title text-start">
                                <strong>
                                    Company : {{ contactData.company }}
                                </strong>

                            </h6>
                            <h6 class="card-title text-start">
                                <strong>
                                    Title : {{ contactData.title }}
                                </strong>

                            </h6>
                            <h6 class="card-title text-start">
                                <strong>
                                    Group : {{ contactData.group.group }}
                                </strong>

                            </h6>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>

    import axios from 'axios'
    import Spinner from '../components/Spinner'

    export default {
        name: "ViewContact",
        components : { Spinner },
        data : function () {
            return {
                id : this.$route.params.id,
                contactData: {},
                error : null,
                loading: false,
            }
        },
        created: async function(){
            try {
                this.loading = true
                const response = await axios.get(process.env.VUE_APP_BASE_URL +'/contact/view/'+this.id);
                this.contactData = response.data.contact,
                this.loading = false
            }catch (e) {
                this.error =  e.message,
                this.loading = false
            }
        }
    }
</script>

<style scoped>
    .back-button{
        float: left;
    }
</style>