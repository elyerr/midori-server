<template>
    <v-modal
        styles="bg-danger btn-sm"
        :button_accept_show="false"
        :target="'token__' + token.id"
        button_cancel_name="Cancelar"
    >
        <template v-slot:button> Revoke </template>
        <template v-slot:head> Revocar token </template>
        <template v-slot:body>
            <div class="text-md">
                <span class="text-danger">
                    Estas seguro que deseas revocar el acceso a este token?
                </span>
                <span class="text-info">
                    Cuando revocas el token todos los usuarios que lo esten
                    usando perderan el acceso a los recursos que esten
                    ejecutando.
                </span>
                <br /><br />
                <button
                    @click="removeToken(token)"
                    class="btn btn-block btn-primary"
                    data-bs-dismiss="modal"
                >
                    Aceptar
                </button>
            </div>
        </template>
    </v-modal>
</template>
<script> 
export default {
    emits: ["tokenWasRevoked"],

    props: {
        token: {
            type: Object,
            required: true,
        },
    },
 

    methods: {
        removeToken(token) {
            this.$server
                .delete("/oauth/tokens/" + token.id)
                .then((res) => {
                    this.$emit("tokenWasRevoked", token);
                })
                .catch((e) => {
                    console.log(e);
                });
        },
    },
};
</script>
<style lang=""></style>
