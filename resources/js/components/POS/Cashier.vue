<template>
  <v-layout>
    <v-card flat>
      <v-form>
        <v-container>
          <v-layout row wrap>
            <v-flex md6>
              <v-text-field id="lname" type="text" label="Trans ID" required autofocus disabled/>
            </v-flex>
            <v-flex md6>
              <v-text-field id="lname" type="text" label="Date" v-model="date" required autofocus disabled/>
            </v-flex>
          </v-layout>
        </v-container>
      </v-form>

      <v-layout column md6>
        <v-data-table :headers="headersCart" :items="selected" class="elevation-1">
          <template slot="items" slot-scope="prod">
            <td>{{ prod.item.id }}</td>
            <td class="text-xs-left">{{ prod.item.name }}</td>
            <td class="text-xs-left">{{ prod.item.price }}</td>
            <td class="text-xs-left">{{ prod.item.quantity}}</td>
            <td class="text-xs-left">{{ prod.item.total}}</td>
          </template>
        </v-data-table>
      </v-layout>

      <v-form>
        <v-container>
          <v-layout row wrap>
            <v-flex md6>
              <v-text-field id="total" type="text" label="Total" v-model="total" required autofocus disabled/>
            </v-flex>
            <v-flex md6>
              <v-text-field id="lname" type="text" label="Amount Rendered" required autofocus/>
            </v-flex>
          </v-layout>
          <v-flex md6>
            <v-text-field id="lname" type="text" label="Change" required autofocus disabled/>
          </v-flex>
        </v-container>
      </v-form>
    </v-card>
    <v-card flat>
      <v-layout column md6>
        <v-data-table :headers="headersProduct" :items="products" class="elevation-1" v-model="selected">
          <template slot="items" slot-scope="prod">
            <tr @click="openDialog(prod.item)">
              <td>{{ prod.item.id }}</td>
              <td class="text-xs-left">{{ prod.item.name }}</td>
              <td class="text-xs-left">{{ prod.item.price }}</td>
              <td class="text-xs-left">{{ prod.item.points}}</td>
            </tr>
          </template>
        </v-data-table>
      </v-layout>
    </v-card>
    <!-- Dialog -->
    <v-dialog v-model="AddQttyDialog" max-width="400px">
      <v-card>
        <v-card-title class="headline">Add Quantity</v-card-title>
        <!-- {{productName}} -->
        <v-card-text>
          <p display-1>Add Quantity for: {{productName}}</p>
          <v-text-field label="ProductQtty" id="prod_qtty" v-model="productQtty"></v-text-field>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn type="submit" color="green darken-1" flat @click="addToCart();">ADD TO CART</v-btn>
          <v-btn color="green darken-1" flat @click="AddQttyDialog = false">CANCEL</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-layout>
</template>

<script>
export default {
  data() {
    return {
      date: Date.now(),
      productName: "",
      productQtty: "",
      products: [],
      selected: [],
      details: [],
      total: 0,
      change: "",
      AddQttyDialog: false,
      headersProduct: [
        { text: "Id", value: "id" },
        { text: "Product Name", value: "prod_name" },
        { text: "Price", value: "prod_price" },
        { text: "Quantity", value: "prod_points" }
      ],
      headersCart: [
        { text: "Id", value: "id" },
        { text: "Product Name", value: "prod_name" },
        { text: "Price", value: "prod_price" },
        { text: "Quantity", value: "prod_qtty" },
        { text: "Total", value: "prod_total" },
      ]
      
    };
  },
  methods: {
    addToCart(){
      if (parseInt(this.productQtty) <=0)
      {
        alert('Enter a valid quantity')
        return false
      }
      if (parseInt(this.productQtty) > parseInt(this.details.points))
      {
        alert('Quantity not enough')
        return false
      }
      var existing = false
      this.selected.find(selected =>
      {
        if (selected.id == this.details.id)
        {
          selected.quantity = parseInt(selected.quantity) + parseInt(this.productQtty)
          selected.total = selected.price * selected.quantity
          existing = true
        }
      })
      
      if (existing == false)
      {
        this.selected.push({
          id: this.details.id,
          name: this.details.name,
          price: this.details.price,
          quantity: this.productQtty,
          total: this.details.price * this.productQtty,
        })
      }
      this.total += (this.details.price * this.productQtty)
      this.products.find(product => { if (product.id == this.details.id) { product.points -= this.productQtty } })
      this.AddQttyDialog = false
    },
    openDialog(data) {
      this.details = data;
      this.productName = data.name;
      this.AddQttyDialog = true;
    },
    loadProducts() {
      axios.get("api/cashier/getProducts").then(response => {
        this.products = response.data.products;
        this.AddQttyDialog = false;
      });
    },
    AddQtty() {
      // if (event.target.classList.contains('btn__content')) return;
      // alert('Alert! \n' + a.name);
    }
  },
  created() {
    this.loadProducts();
  }
};
</script>
  