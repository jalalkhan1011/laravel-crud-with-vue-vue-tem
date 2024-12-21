<template>
    <navbar-section></navbar-section>
    <div id="layoutSidenav">
        <sidebar-section></sidebar-section> 
        <div id="layoutSidenav_content">
            <router-view></router-view>
            <footer-section></footer-section>
        </div>
    </div>
</template>
<script>
import NavbarSection from './Backend/NavbarSection.vue'
import SidebarSection from './Backend/SidebarSection.vue'
import FooterSection from './Backend/FooterSection.vue'
export default {
    components: {
        'navbar-section': NavbarSection,
        'sidebar-section': SidebarSection,
        'footer-section': FooterSection
    }
}
</script>
<style scoped></style>