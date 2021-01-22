<template>
    <div class="heart" @click="likeReceta"></div>
</template>

<script>
export default {
    props: ['recetaId'],
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