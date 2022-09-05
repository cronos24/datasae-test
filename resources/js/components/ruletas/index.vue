<template>
    <div class="container-fluid">  

   
  
            <v-data-table
            :headers="headers"
            :items="this.ruletas_list"
            :items-per-page="10"
            class="elevation-2"
        >

        <template v-slot:[`item.acciones`]="{ item }">
            <v-icon
                small
                class="mr-2"
                @click="verItem(item)"
            >
                mdi-eye
            </v-icon>
         
        </template>
 
        </v-data-table>

     
    </div>
</template>

<script>
    export default {
        props: [
            'ruletas'
        ],
        data () {
            return {
                 dialog: false,
                 valid: true,
                 dialogDelete: false,
                 ruletas_list : this.ruletas,
                 scenario: null,
                headers: [    
                { text: 'Fecha', value: 'fecha' },                
                { text: 'Total Apostado', value: 'valor_apostado' },
                { text: 'Valor Pagado', value: 'valor_pagado' },
                { text: 'Estado', value: 'acciones', sortable: false },
                ],               
                url: '/api/jugadores',
                errors: []
            }
        },
        methods: {
        
          verItem(item){
            console.log(item);       
        },
 
        async refresh(){
          await axios
          .get('/ruletas/refresh')
          .then(response => {    
         
            this.ruletas_list = response.data;
          })
          .catch(error => {
               console.log(error)
        });
        }

        },
        mounted() {
          Echo.channel(`spin-tracker`)
          .listen('SpinRouletteEvent', (e) => {
              this.refresh()
          });

        },
        
            
    }
</script>
