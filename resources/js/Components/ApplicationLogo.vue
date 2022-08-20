<template>
    <img :src="getImage('logo.png')" alt="logo" :style="'width:'+width"/>
</template>
<script>
import Helpers from '@/Mixins/Helpers';
export default {
    props: ['width'],
    mixins: [Helpers]
}
</script>