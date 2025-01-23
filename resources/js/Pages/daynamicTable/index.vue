<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card mt-5">
          <div class="card-header">
            <div class="row">
              <div class="col-md-6">Purchase list</div>
              <div class="col-md-6 text-end">
                <router-link
                  :to="{ name: 'productPurchase.create' }"
                  class="btn btn-sm btn-info text-white font-bold"
                  >Purchase Create</router-link
                >
              </div>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#Sl</th>
                  <th>Invoice</th>
                  <th>Date</th>
                  <th>Sub total</th>
                  <th>Total</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(productBuy, key) in productBuys" :key="productBuy.id">
                  <td>{{ key + 1 }}</td>
                  <td>{{ productBuy.uuid }}</td>
                  <td>{{ productBuy.created_at }}</td>
                  <td>{{ productBuy.sub_total }}</td>
                  <td>{{ productBuy.total }}</td>
                  <td>
                    <router-link
                      :to="{
                        name: 'productPurchase.edit',
                        params: { id: productBuy.id },
                      }"
                      class="btn btn-primary"
                      title="Prchase Edit"
                      >Edit</router-link
                    >
                    <!-- <button v-on:click="deletePost(post.id)" class="btn btn-danger">
                      Delete
                    </button> -->
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import toastr from "toastr";
export default {
  name: "ProductBuys",
  data() {
    return {
      productBuys: [],
    };
  },
  mounted() {
    this.getProductBuys();
  },
  methods: {
    async getProductBuys() {
      try {
        let res = await axios.get("/api/products/buy");
        this.productBuys = res.data.productBuys;
      } catch (error) {
        toastr.error("Something went wrong");
      }
    },
  },
};
</script>

<style></style>
