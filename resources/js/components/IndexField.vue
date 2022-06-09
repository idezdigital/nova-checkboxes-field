<template>
    <span class="tw-w-full tw-flex tw-flex-wrap tw-gap-1 tw-max-w-sm">
        <span
            v-for="(value, option) in availableOptions"
            :key="option"
            :title="value"
            :class="`tw-inline-block tw-rounded-full tw-w-2 tw-h-2 ${
                optionIsActive(option) ? 'tw-bg-green-500' : 'tw-bg-red-500'
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
