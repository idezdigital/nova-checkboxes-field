<template>
    <span
        class="tw-w-full tw-flex tw-flex-wrap tw-gap-1 tw-max-w-sm"
        v-if="field.withGroups"
    >
        <span
            v-for="option in availableOptions"
            :key="option.value"
            :title="option.label"
            :class="`tw-inline-block tw-rounded-full tw-w-2 tw-h-2 ${
                optionIsActive(option.value)
                    ? 'tw-bg-green-500'
                    : 'tw-bg-red-500'
            }`"
        />
    </span>
    <span class="tw-w-full tw-flex tw-flex-wrap tw-gap-1 tw-max-w-sm" v-else>
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
            const options = this.field.options;

            if (!this.field.withGroups) {
                return options;
            }

            return _.flatMap(this.field.options);
        },
    },

    methods: {
        optionIsActive(option) {
            if (!this.field.value) {
                return false;
            }

            if (!this.field?.withGroups) {
                return this.field.value.includes(option);
            }

            return _.flatMap(this.field.value).includes(option);
        },
    },
};
</script>
