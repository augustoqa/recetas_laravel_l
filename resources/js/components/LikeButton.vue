<template>
    <div>
        <div class="heart" @click="likeReceta" :class="{ 'is-active' : this.like }"></div>
        <p>{{ cantidadLikes }} Les gustó esta receta</p>
    </div>
</template>

<script>
export default {
    props: ['recetaId', 'like', 'likes'],
    data: function () {
        return {
            totalLikes: this.likes
        }
    },
    methods: {
        likeReceta() {
            axios.post('/recetas/' + this.recetaId)
                .then(respuesta => {
                    if (respuesta.data.attached.length > 0) {
                        this.$data.totalLikes++;
                    } else {
                        this.$data.totalLikes--;
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        }
    },
    computed: {
        cantidadLikes: function () {
            return this.totalLikes;
        }
    }
}
</script>