<template>
  <div class="container">
        <br>
<div class="row">
      <div class="col-md-4 order-md-2 mb-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-muted">Carrito</span>
          <span class="badge badge-secondary badge-pill">{{listCarrito.length}}</span>
        </h4>
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0">Producto</h6>
              <small class="text-muted"></small>
            </div>
            <span class="text-muted">{{listCarrito.lentgh}}</span>
          </li>
          <li v-for="(itemcart,i) in listCarrito" class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0">{{itemcart.nombre}}</h6>
              <small class="text-muted">{{itemcart.categoria}}</small>
            </div>

            <div>
              <div>
                <i class="material-icons"  v-on:click="cambiarCantidad(i,false)">remove_circle_outline</i>
                <span class="text-muted"> {{itemcart.cant}}</span>
                <i class="material-icons"  v-on:click="cambiarCantidad(i, true)">add_circle_outline</i>
              </div>
              <span class="text-muted"> {{Moneda(itemcart.cant * itemcart.precio)}}</span>
            </div>

            <i class="material-icons"  v-on:click="deleteItem(i)">delete</i>

          </li>

          <li class="list-group-item d-flex justify-content-between">
            <span>Total (PESOS)</span>
            <strong> {{onViewTotal()}}</strong>
          </li>
          <button @click="Comprar()" class="btn btn-danger">Comprar</button>
        </ul>
                <h4 class="mb-3">Filtros</h4>

  <div class="list-group">
              <span @click="ListarProductos()" class="badge badge-danger">Quitar filtro</span>
              <a v-for="(c,i) in categorias.data" href="#" class="list-group-item list-group-item-action" v-on:click="idCategoria(c.id)">
               {{c.nombre}}<span class="tag tag-pill tag-default pull-xs-right"></span>
              </a>
            </div> 

      </div>


        <div class="col-md-8 order-md-1">

           <h4 class="mb-3">PruebaKubo2020 - 09/03/2020</h4>

        <hr>

        <div class="row">

          <div class="row">

          <div class="card col-md-4" style="padding:0px;" v-for="(p, index) in productos.data">
          <img  class="card-img-top" v-bind:src="p.imagenes" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">{{p.titulo}}</h5>
              <p class="card-text">{{p.descripcion}}</p>
               <button @click="VerProducto(p.id)" class="btn btn-success ">Ver mas</button>
        <a href="#" class="btn btn-primary" v-on:click="AgregarCarrito(p)">Agregar al carrito</a>
            </div>
          </div>

        </div>

        </div>


      </div>
       <!---modal ver cotizacion-->
    <div class="modal fade" tabindex="-1" role="dialog" id="ver_producto">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                     <h5 class="modal-title">Vista Producto</h5>
                </div>
                <div class="modal-body">
                   <div class="card">
          <img  class="card-img-top img-fluid" v-bind:src="producto.imagenes" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">{{producto.titulo}}</h5>
            <p class="card-text">{{producto.descripcion}}</p>
        <a href="#" class="btn btn-primary" v-on:click="AgregarCarrito(producto)">Agregar al carrito</a>
          </div>
        </div>
                </div>
            </div>
        </div>
    </div>
    <!--modal ver cotizacion--->
    </div><!--row-->
  </div> <!-- /container -->
</template>


<script>
export default {
    data() {
        return {
            productos: [],
            producto: [],
            listCarrito:[],
            cart:[],
            categorias:[]
        }
    },
    mounted () {
        this.ListarProductos()
        this.ListarCategorias()
        //this.idCategoria()
        //this.verProducto();
    },

    methods: {

       ListarProductos(){

        axios.get('/api/productos').then(response => {
                this.productos = response
            }).catch(error => {
                console.log(error)
                this.errored = true
            }).finally(() => this.loading = false)
        },

        VerProducto(index){

        axios.get('/api/verproducto/' + index).then(response => {
                this.producto = response['data']
                $("#ver_producto").modal("show");
                //this.productoid = index
            }).catch(error => {
                console.log(error)
                this.errored = true
            }).finally(() => this.loading = false)
        },

        Moneda(value){

          const formatterPeso = new Intl.NumberFormat('es-CO', {
             style: 'currency',
             currency: 'COP',
             minimumFractionDigits: 0
           })
           let valueFinal = formatterPeso.format(value);


           return valueFinal

          },

        AgregarCarrito(item){
            const itemcar = {
              id : item.id,
              nombre : item.titulo,
              categoria: item.categoria_id,
              cant: 1,
              precio: item.precio
            }

            this.listCarrito.push(itemcar)
            $("#ver_producto").modal("hide");
            //alert(JSON.stringify(item))
          },
          deleteItem(i){ 
            this.listCarrito.splice(i,1) 
          },
          cambiarCantidad(i,type){

              // sacar variable de carrito
              const dataCar = this.listCarrito

              // sacar la cantidad de producto
              let cantd = dataCar[i].cant;

              if (type) {
                cantd = cantd + 1
              }
              else if (type==false&&cantd>=1) {
                cantd = cantd - 1
              }

              if ((type==false&&cantd>=1)||type) {
                dataCar[i].cant = cantd
                this.listCarrito
              }


          },
          onViewTotal(){
            let total = 0
            this.listCarrito.map((data)=>{
              total = total + (data.cant * data.precio)
            })

            return this.Moneda(total)
          },

           Comprar() {

            if (this.listCarrito.length>=1) {

              // sumar todal de los productos
              let total = 0
              this.listCarrito.map((data)=>{
                total = total + (data.cant * data.precio)
              })

              const formData = new FormData()
              formData.append('pedidos',JSON.stringify(this.listCarrito))
              formData.append('total',total)

              //console.log(formData);

              axios.post("api/shop",formData)
              .then(response => {
                alert("Enviado exitosamente");
                this.listCarrito = []
              })
              .catch(error => {
                alert(error)
              })

            }


          },

          ListarCategorias(){
            axios.get('/api/categorias').then(response => {
                this.categorias = response
            }).catch(error => {
                console.log(error)
                this.errored = true
            }).finally(() => this.loading = false)
          },
          idCategoria(id){
              axios.get('/api/filtro/' + id).then(response => {
                this.productos = response
            }).catch(error => {
                console.log(error)
                this.errored = true
            }).finally(() => this.loading = false)
          }

    }
}
</script>
