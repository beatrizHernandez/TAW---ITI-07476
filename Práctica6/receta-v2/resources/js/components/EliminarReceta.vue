<template>
    <input 
        type="submit" 
        class="btn btn-danger mr-1 d-block mb-2 w-100" value="Eliminar"
        @click="eliminarReceta"   
    >   
</template>

<script>
    export default {
        props: ['recetaId'],
        mounted() {
            //console.log('Eliminando', this.recetaId)
        },
        methods: {
            eliminarReceta() {
                this.$swal({
                    title: '¿Desea eliminar esta receta?',
                    text: "Confirmación...",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí',
                    cancelButtonText: 'No'
                }).then((result) => {
                if (result.value) {
                    const params = {
                        id: this.recetaId
                    }
                    //Enviar peticion al servidor
                    axios.post(`/recetas/${this.recetaId}`, {params, _method: 'delete'})
                    .then(respuesta => {
                        console.log(respuesta)
                        
                        this.$swal({
                            title: 'Receta eliminada.',
                            text: 'Se eliminó la receta',
                            icon: 'success'
                        });
                        //Eliminar receta del DOM
                        this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);
                    })
                    .catch(error => {
                        console.log(error)
                    })
                }
                })
            }
        }
    }
</script>