<template>
    <div class="heart" @click="likeReceta" :class="{ 'is-active' : this.like }"></div>
</template>

<script>
export default {
    props: ['recetaId', 'like'],
    methods: {
        likeReceta() {
            axios.post('/recetas/' + this.recetaId)
                .then(respuesta => {
                    console.log(respuesta);
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
}
</script>