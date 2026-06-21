<template>
    <div>
        <h2>Livestream Room Initialized</h2>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

onMounted(() => {
    console.log('Livestream Room component mounted.');
});
</script>

<style scoped></style>