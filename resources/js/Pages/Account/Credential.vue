<template>
    <div class="container-fluid text-center">
        <button class="btn btn-danger py-3" @click="revocarCredentials">
            Revocar todos las credenciales generadas
        </button>

        <span v-show="message" class="pt-5 d-block text-success">
            {{ message }}
        </span>
    </div>
</template>
<script>
export default {
    data() {
        return {
            message: null,
        };
    },

    methods: {
        revocarCredentials() {
            this.$server
                .delete("/api/oauth/credentials/revoke")
                .then((res) => {
                    this.message = res.data.message;
                })
                .catch((e) => {
                    console.error(e.response);
                });
        },
    },
};
</script>
<style lang=""></style>
