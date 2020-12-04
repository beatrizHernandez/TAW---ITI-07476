<template>
    <input type="submit" class="btn btn-danger " value="Eliminar" @click="eliminarReceta">   
</template>

<script>
    export default {
        props: ['recetaId'],
        mounted() {
            //console.log('Eliminando', this.recetaId)
            //console.log('Prueba eliminando, this.recetaId')
        },
        methods: {
            eliminarReceta() {
                this.$swal({
                    title: '¿Desea eliminar esta receta?',
                    text: "Confirmación...",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#19D024',
                    cancelButtonColor: '#DF1414',
                    confirmButtonText: 'Sí',
                    cancelButtonText: 'No'
                }).then((result) => {
                if (result.value) {
                    const params = {
                        id: this.recetaId
                    }
                    //Enviar peticion previa al servidor
                    //Dentro de servidor se llevará a cabo el borrado
                    axios.post(`/recetas/${this.recetaId}`, {params, _method: 'delete'})
                    .then(respuesta => {
                        console.log(respuesta)
                        
                        //Sweet alert de jquery
                        this.$swal({
                            title: 'Receta eliminada.',
                            text: 'Se eliminó la receta',
                            icon: 'success'
                        });
                        //Eliminar receta 
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