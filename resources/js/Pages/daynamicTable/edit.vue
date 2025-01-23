<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-12">
        <form action="">
          <table class="table table-bordered mt-2">
            <thead>
              <tr>
                <th>#Sl</th>
                <th>Product Name</th>
                <th>Batch</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>
                  <button
                    type="button"
                    class="btn btn-sm btn-info"
                    v-on:click="addNewRow()"
                  >
                    <i class="fa fa-plus"></i>
                  </button>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(invoice_product, k) in invoice_products" :key="k">
                <td>
                  <input
                    type="text"
                    class="form-control"
                    v-model="invoice_product.product_no"
                  />
                </td>
                <td>
                  <select
                    class="form-select"
                    v-model="invoice_product.product_id"
                    @change="productIdChange(invoice_product)"
                  >
                    <option value="" selected disabled>Select Product</option>
                    <option
                      v-for="product in products"
                      :key="product.id"
                      :value="product.id"
                    >
                      {{ product.product_name }}
                    </option>
                  </select>
                </td>
                <td>
                  <select
                    class="form-select"
                    v-model="invoice_product.product_purchase_id"
                    @change="productBatechIdChange(invoice_product)"
                  >
                    <option value="" selected disabled>Select Batech</option>
                    <option
                      v-for="batech in productBateches"
                      :key="batech.id"
                      :value="batech.id"
                    >
                      {{ batech.uuid }}
                    </option>
                  </select>
                </td>
                <td>
                  <input
                    type="number"
                    class="form-control text-right"
                    min="0"
                    step=".01"
                    v-model="invoice_product.price"
                    @change="calculateLineTotal(invoice_product)"
                  />
                </td>
                <td>
                  <input
                    type="number"
                    class="form-control text-right"
                    min="0"
                    step=".01"
                    v-model="invoice_product.quantity"
                    @change="calculateLineTotal(invoice_product)"
                  />
                </td>
                <td>
                  <input
                    type="number"
                    class="form-control"
                    min="0"
                    step=".01"
                    v-model="invoice_product.total"
                    readonly
                  />
                </td>
                <td>
                  <button
                    type="button"
                    class="btn btn-sm btn-danger"
                    v-on:click="deleteRow(k, invoice_product)"
                  >
                    <i class="fa fa-trash"></i>
                  </button>
                </td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="5" class="text-end">Subtotal:</td>
                <td>
                  <input
                    type="number"
                    class="form-control"
                    min="0"
                    step=".01"
                    v-model="invoice_subtotal"
                    readonly
                  />
                </td>
                <td></td>
              </tr>
              <tr>
                <td colspan="5" class="text-end">Total:</td>
                <td>
                  <input
                    type="number"
                    class="form-control"
                    min="0"
                    step=".01"
                    v-model="invoice_total"
                    readonly
                  />
                </td>
                <td></td>
              </tr>
            </tfoot>
          </table>
          <div class="form-group mt-2 text-end">
            <button class="btn btn-primary" v-on:click="createProductBuy()">
              Submit
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import toastr from "toastr";
export default {
  name: "Product",
  data() {
    return {
      product: {},
      products: [],
      productBateches: [],
      invoice_subtotal: 0,
      invoice_total: 0,
      invoice_tax: 5,

      invoice_products: [
        {
          product_id: "",
          product_purchase_id: "",
          product_no: "",
          product_name: "",
          price: "",
          quantity: "",
          total: 0,
        },
      ],
    };
  },
  mounted() {
    this.getProducts();
    this.getPurchaseProduct(this.$route.params.id);
  },
  methods: {
    async getProducts() {
      let pro = await axios.get("/api/products");
      this.products = pro.data.products;
      this.productBateches = pro.data.productBateches;
    },
    //daynamacally append proudct batech select option for every product wise id
    async productIdChange(invoice_product) {
      let produtId = invoice_product.product_id;

      let productBatech = await axios.get("/api/products/bateches/" + produtId);

      invoice_product.productBateches = productBatech.data.productBateches;
    },

    // data append daynamically product it wise( user table index and product uuid for every daynamic data append)
    async productBatechIdChange(invoice_product) {
      let batechId = invoice_product.product_purchase_id;

      let productDetails = await axios.get("/api/products/details/" + batechId);

      console.log(productDetails);
      invoice_product.price = productDetails.data.product.price;
    },
    //daynamic table row
    addNewRow() {
      //   alert("Are you sure you want to add a new row?");
      this.invoice_products.push({
        product_no: "",
        product_purchase_id: "",
        product_name: "",
        price: "",
        qty: "",
        total: 0,
      });
    },

    deleteRow(index, invoice_product) {
      //   alert("Are you sure you want to delete this row?");
      var idx = this.invoice_products.indexOf(invoice_product);
      console.log(idx, index);
      if (idx > -1) {
        this.invoice_products.splice(idx, 1);
      }
      this.calculateTotal();
    },
    calculateLineTotal() {
      //   alert("Are you sure you want to calculate line total?");
      this.invoice_products.forEach((invoice_product) => {
        invoice_product.total = invoice_product.price * invoice_product.quantity;
      });
      this.calculateTotal();
    },
    calculateTotal() {
      let total = 0;
      let inv_total = 0;
      this.invoice_products.forEach((invoice_product) => {
        total += invoice_product.total;
      });
      console.log(total);
      this.invoice_subtotal = total;
      inv_total = (total * this.invoice_tax) / 100 + total;
      this.invoice_total = inv_total;
      //   return total;
    },
    async getPurchaseProduct(id) {
      let res = await axios.get(`/api/products/buy/${id}/edit`);
      this.invoice_products = res.data.productItems;
      this.invoice_subtotal = res.data.product.sub_total;
      this.invoice_total = res.data.product.total;
    },
    async createProductBuy() {
      // alert("Are you sure you want to create product buy?");
      try {
        //this declear for save single input fiels and array data
        const productBuy = {
          sub_total: this.invoice_subtotal,
          total: this.invoice_total,
          productItems: this.invoice_products,
        };
        //
        let res = await axios.post("/api/products/buy", productBuy);
        toastr.success("Product buy created successfully");
        this.invoice_products = [
          {
            product_id: "",
            batech_id: "",
            product_no: "",
            product_name: "",
            price: "",
            quantity: "",
            total: 0,
          },
        ];
        this.invoice_subtotal = 0;
        this.invoice_total = 0;
      } catch (error) {
        let errors = error.response.data.errors;
        for (let key in errors) {
          toastr.error(errors[key]);
        }
      }
    },
  },
};
</script>
<style scoped></style>
