<template>
    <div>
        <h1 ref="title">Hooks tutorial</h1>
        <div>My name is {{ name }}</div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            name:'Adil'
        }
    },
    beforeCreate(){
        console.log(this.$refs['title'],this.name);
    },
    created(){
        console.log(this.$refs['title'],this.name);
    },
    mounted(){
        console.log(this.$refs['title'],this.name);
    },
}
</script>