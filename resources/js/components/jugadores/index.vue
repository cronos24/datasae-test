<template>
    <div class="container-fluid">

    <v-btn

      :disabled="loading"
      color="success"
      class="ma-2 white--text"
      rounded 
      @click.stop="crear"
      
    >
      Crear
      <v-icon
        right
        dark
      >
      mdi-plus
      </v-icon>
    </v-btn>

    <v-dialog
      v-model="dialog"
      max-width="60%"
    >
    <v-card>
        <v-card-title>
          <span class="text-h5">Agregar Jugador</span>
        </v-card-title>
        <v-card-text>

            <v-alert
            shaped
            prominent
            dark
            type="error"
            v-if="errors.length != 0"
            >
            <strong>Por favor, corrija el(los) siguiente(s) error(es):</strong>
            <ul>
                    <div v-for="(error, index) in errors" v-bind:key="index">
                        <li v-for="er in error" v-bind:key="er" v-html="er"></li>
                    </div>                
                </ul> 
            </v-alert>
            
          <v-container>

            <v-form
                ref="form"
                v-model="valid"
                lazy-validation
            >

            <v-row>
                <v-col
                cols="12"
                sm="6"
                md="4"
              >
                <v-text-field
                  v-model="model.n_documento"
                  label="No. Documento*"
                  min="0"
                  type="number"
                  :rules="modelRules.n_documento"
                  required
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
                sm="6"
                md="4"
              >
                <v-text-field
                  v-model="model.nombres"
                  label="Nombres*"
                  required
                  :rules="modelRules.nombres"
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
                sm="6"
                md="4"
              >
                <v-text-field
                  v-model="model.apellidos"
                  label="Apellidos*"
                  required
                  :rules="modelRules.apellidos"
                ></v-text-field>
              </v-col>

              <v-col
                cols="12"
                sm="6"
                md="4"
              >
                <v-text-field
                  v-model="model.telefono"
                  label="Telefono*"
                  type="number"
                  required
                  :rules="modelRules.telefono"
                ></v-text-field>
              </v-col>

              <v-col
                cols="12"
                sm="6"
                md="4"
              >
                <v-text-field
                  v-model="model.dinero"
                  label="Dinero*"
                  type="number"
                  required
                  min= "10000"
                  :rules="modelRules.dinero"
                ></v-text-field>
              </v-col>
              
              
            </v-row>
            </v-form>
            
          </v-container>
          <small>*indica los campos obligatorios.</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="blue darken-1"
            text
            @click="cancel()"
          >
            Cancelar
          </v-btn>
          <v-btn
            color="blue darken-1"
            text
            @click="submit()"
          >
            Guardar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog> 
  
            <v-data-table
            :headers="headers"
            :items="this.jugadores_list"
            :items-per-page="10"
            class="elevation-2"
        >
        <template v-slot:[`item.full_name`]="{ item }">{{ item.nombres +' '+ item.apellidos }}</template>
        <template v-slot:[`item.acciones`]="{ item }">
            <v-icon
                small
                class="mr-2"
                @click="editItem(item)"
            >
                mdi-pencil
            </v-icon>
            <v-icon
                small
                @click="deleteItem(item)"
            >
                mdi-delete
            </v-icon>
        </template>
 
        </v-data-table>

     
    </div>
</template>

<script>
    export default {
        props: [
            'jugadores'
        ],
        data () {
            return {
                 dialog: false,
                 valid: true,
                 dialogDelete: false,
                 jugadores_list : this.jugadores,
                 scenario: null,
                headers: [
                { text: 'Documento', value: 'n_documento' }, 
     
                {
                    text: 'Nombre',
                    align: 'start',
                    sortable: true,
                    value: 'full_name',
                },                
                { text: 'Telefono', value: 'telefono' },
                { text: 'Dinero', value: 'dinero' },
                { text: 'Acciones', value: 'acciones', sortable: false },
                ],
                model:{
                    n_documento: null,
                    nombres: null,
                    apellidos: null,
                    telefono: null,
                    dinero:10000
                },
                modelRules:{
                    n_documento: [ 
                        v => !!v || 'No. Documento es obligatorio', 
                        v => (v && v > 0) || 'No. Documento debe ser mayor a  0',],
                    nombres: [
                        v => !!v || 'Nombres es obligatorio',
                        v => (v && v.length <= 60) || 'Nombres no puede tener mas de 60 caracteres',
                    ],
                    apellidos: [
                        v => !!v || 'Apellidos es obligatorio',
                        v => (v && v.length <= 60) || 'Apellidos no puede tener mas de 60 caracteres',
                    ],
                    telefono: [
                        v => !!v || 'Telefono es obligatorio', 
                        v => (v && v >= 0) || 'Telefono no puede ser menor a  0'
                    ],
                    dinero:[
                        v => !!v || 'Dinero es obligatorio',
                        v => (v && v >= 10000) || 'El dinero inicial no puede ser menor a 10000',
                    ]
                },
                loader: null,
                loading: false,
                url: '/api/jugadores',
                errors: []
            }
        },
        methods: {

        crear() {
            this.dialog = true
            this.scenario = 'create'
        },
        editItem(item){
            this.model= JSON.parse(JSON.stringify(item));
            this.scenario = 'update'
            this.dialog = true
        },
        async submit(){
            //this.dialog = false
            
            if (this.$refs.form.validate()) {  
                
                
                if (this.scenario=='create') {
                    await axios
                    .post(this.url, this.model)
                    .then(response => {
                        this.dialog = false
                        if (response.data.status=="success") {                        
                            this.jugadores_list.unshift(response.data.response);
                        }else{
                            this.errors = response.data.response; 
                        }
                    
                    }).catch(err => {
                    console.log(err)
                    });
                    
                }else{
                    await axios
                    .put(this.url+'/'+this.model.id, this.model)
                    .then(response => {
                        this.dialog = false
                        if (response.data.status=="success") {                        

                            var selectItemIndex = this.jugadores_list.map(j => j.id).indexOf(this.model.id);                         
                            this.$set(this.jugadores_list, selectItemIndex, this.model)
                        }else{
                            this.errors = response.data.response; 
                        }
                    
                    }).catch(err => {
                    console.log(err)
                    });
                }

                
            }
        },
        
        async deleteItem (item) {
            if (confirm('Seguro de Borrar el registro ?')) {
                await axios
                .delete(this.url+'/'+item.id)
                .then(response => { 
                    if (response.data==1) {
                        var selectItemIndex = this.jugadores_list.map(j => j.id).indexOf(item.id);
                        this.jugadores_list.splice(selectItemIndex, 1)
                    } 
                }).catch(err => {
                console.log(err)
                });

                
            }            
                   
        },
        cancel(){
     
            this.$refs.form.reset()
            this.$refs.form.resetValidation()
           
            this.model={
                    n_documento: null,
                    nombres: null,
                    apellidos: null,
                    telefono: null,
                    dinero:10000
                },
            this.dialog = false
        },
        async refresh(){
          await axios
          .get('/jugadores/refresh')
          .then(response => {    
         
            this.jugadores_list = response.data;
          })
          .catch(error => {
               console.log(error)
        });
        }

        },
        mounted() {
          Echo.channel(`jugadores-tracker`)
          .listen('JugadoresEvent', (e) => {
              this.refresh()
          });

        },
        
            
    }
</script>
