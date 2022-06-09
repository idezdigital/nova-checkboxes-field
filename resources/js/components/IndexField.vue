<template>
    <span class="w-full flex flex-wrap gap-1 max-w-sm">
        <span
            v-for="(value, option) in availableOptions"
            :key="option"
            :title="value"
            :class="`inline-block rounded-full w-2 h-2 ${
                optionIsActive(option) ? 'bg-green-500' : 'bg-red-500'
            }`"
        />
    </span>
</template>

<script>
export default {
    props: ["resourceName", "field"],

    computed: {
        availableOptions() {
            return this.field.options;
        },
    },

    methods: {
        optionIsActive(option) {
            return this.field.value && this.field.value.includes(option);
        },
    },
};
</script>
