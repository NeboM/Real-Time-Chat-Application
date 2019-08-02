<template>

    <div>
        <h5  data-aos="fade-up"
             data-aos-delay="0"
             data-aos-duration="1000" class="text-center mb-4">Users to chat with</h5>

        <div class="text-center offset-lg-4 col-lg-4 offset-md-2 col-md-8">
            <ul class="list-group">
                <div v-for="user in this.users">
                    <li data-aos="fade-up"
                        data-aos-delay="300"
                        data-aos-duration="1000" class="list-group-item">
                        <p class="custom-width"><a :href="'/'+user.id">{{ user.name }}</a></p>
                    </li>
                </div>
            </ul>
        </div>
        <div class="space"></div>
    </div>
</template>

<script>
    export default {
        name: "UserComponent",
        props: ['users']
    }
</script>

<style scoped>
    .space {
        width: 100%;
        height: 150px;
    }
</style>
