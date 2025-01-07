<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-12">
        <table class="table table-bordered mt-2">
          <thead>
            <tr>
              <th>#Sl</th>
              <th>Product Name</th>
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
                <!-- <input
                  type="text"
                  class="form-control"
                  v-model="invoice_product.product_name"
                /> -->
                <select class="form-select" v-model="invoice_product.product_id">
                  <optgroup v-for="product in products" :key="product.id">
                    <option :value="product.id">
                      {{ product.product_name }}
                    </option>
                  </optgroup>
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
                  v-model="invoice_product.qty"
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
              <td colspan="4" class="text-end">Subtotal:</td>
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
              <td colspan="4" class="text-end">Total:</td>
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
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import toastr from "toastr";
export default {
  name: "Produts",
  data() {
    return {
      products: [],
      invoice_subtotal: 0,
      invoice_total: 0,
      invoice_tax: 5,
      invoice_products: [
        {
          product_id: "",
          product_no: "",
          product_name: "",
          price: "",
          qty: "",
          total: 0,
        },
      ],
    };
  },
  mounted() {
    this.getProducts();
  },
  methods: {
    async getProducts() {
      let pro = await axios.get("/api/products");
      this.products = pro.data.products;
    },
    //daynamic table row
    addNewRow() {
      //   alert("Are you sure you want to add a new row?");
      this.invoice_products.push({
        product_no: "",
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
        invoice_product.total = invoice_product.price * invoice_product.qty;
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
  },
};
</script>
<style scoped></style>
