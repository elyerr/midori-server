<template>
    <div class="row row-cols-3 col-12 text-start">
        <div
            class="col form-check"
            v-for="(item, index) in scopes"
            :key="index"
        >
            <input
                class="form-check-input px-0"
                type="checkbox"
                :value="item.id"
                :id="item.id"
                @click="isSelected(item.id)"
            />
            <label class="form-check-label" :for="item.id">
                <span class="fw-bold">{{ item.id }}</span>
                : {{ item.description }}
            </label>
        </div>
    </div>
</template>
<script>
export default {
    emits: ["scopesSelected"],

    data() {
        return {
            scopes: {},
            scopesSelected: [],
        };
    },

    mounted() {
        this.getScopes();
        this.scopesSelected = [];
        this.listenEvent();
    },

    methods: {
        isSelected(id) {
            const position = this.scopesSelected.indexOf(id);
            if (position != -1) {
                this.scopesSelected.splice(position, 1);
            } else {
                this.scopesSelected.push(id);
            }
            this.$emit("scopesSelected", this.scopesSelected);
        },

        getScopes() {
            this.$server
                .get("oauth/scopes")
                .then((res) => {
                    this.scopes = res.data;
                })
                .catch((e) => {});
        },

        listenEvent() {
            this.$echo
                .private(this.$channels.ch_0())
                .listen(".StoreRoleEvent", (e) => {
                    this.getScopes();
                })
                .listen(".UpdateRoleEvent", (e) => {
                    this.getScopes();
                })
                .listen(".DestroyRoleEvent", (e) => {
                    this.getScopes();
                });
        },
    },
};
</script> 