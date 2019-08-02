<template>
    <div>

        <h4 data-aos="fade-up"
            data-aos-offset="200"
            data-aos-delay="0"
            data-aos-duration="1000" class="text-center mt-5 mb-4">You can login with: </h4>

        <div v-for="email in this.emails">


        <p data-aos="fade-up"
           data-aos-offset="200"
           data-aos-delay="150"
           data-aos-duration="1000" class="text-center"><b><i>{{email.email}}</i></b></p>

        </div>
        <div v-if="this.emails.length === 0">
            <p class="text-center">You may run <b>php artisan db:seed</b> to generate users and messages or you may <a href="/register">register</a></p>
        </div>
        <div v-else>
            <p data-aos="fade-up"
               data-aos-offset="200"
               data-aos-delay="350"
               data-aos-duration="1000" class="text-center">Password: <i>password</i></p>
        </div>


        <div class="space"></div>
    </div>
</template>

<script>
    export default {
        name: "LoginComponent",
        props: ['emails'],
    }
</script>

<style scoped>
    .space {
        height: 150px;
        width: 100%;
    }
</style>
