<template>
  <div class="container">

    <v-data-table
            :headers="headers"
            :items="this.apuestas"
            :items-per-page="5"        
            :item-class="itemRowBackground"
            class="elevation-2"
        >
        <template v-slot:top>
        <v-toolbar flat>
            <v-toolbar-title>Apuestas</v-toolbar-title>      
        </v-toolbar>
        </template>
        <template v-slot:[`item.full_name`]="{ item }">{{ item.jugador.nombres +' '+ item.jugador.apellidos }}</template>
        <template v-slot:[`item.color_name`]="{ item }">{{ item.color.color }}</template>
        <template v-slot:[`item.estado`]="{ item }">{{ (item.estado=='G') ? 'Ganador':'Perdedor' }}</template>
    </v-data-table>
  </div>
</template>

<script>
export default {
    props: ['ruleta'],
    mounted() {
          console.log(this.ruleta);

          this.getApuestas(this.ruleta);
    },
    data(){
        return {                
            model: this.ruleta,  
            apuestas: [],
            headers: [    
                {
                    text: 'Jugador',
                    align: 'start',
                    sortable: true,
                    value: 'full_name',
                },                
                { text: 'Valor Apostado', value: 'valor'},
                { text: 'Color Seleccionado', value: 'color_name' },    
                { text: 'Resultado', value: 'estado'},               
                ],
        };
    },
    methods: {
        itemRowBackground: function (item) {
            return item.estado == 'G' ? 'style-1' : null
        },
        
      async getApuestas(item){

        await axios
            .get('/api/apuestas/'+item.id)
            .then(response => {    
                this.apuestas = response.data
            })
            .catch(error => {
                console.log(error)
        });       
      },

      

      },
}
</script>

<style>
.style-1 {
  background-color: rgb(182, 228, 138)
}
</style>