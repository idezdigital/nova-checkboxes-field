<template>
    <PanelItem :index="index" :field="field">
        <template #value>
            <div class="tw-w-full tw-columns-2" v-if="field.withGroups">
                <div
                    v-for="(groupOptions, group) in field.options"
                    :key="group"
                    class="tw-mb-4"
                >
                    <h3 class="tw-my-2 tw-text-lg tw-font-semibold">
                        {{ group }}
                    </h3>
                    <div
                        v-for="(label, value) in groupOptions"
                        :key="value"
                        class="tw-flex-auto"
                    >
                        <span
                            :title="label"
                            :class="`tw-inline-block tw-rounded-full tw-w-2 tw-h-2 ${
                                optionIsActive(value)
                                    ? 'tw-bg-green-500'
                                    : 'tw-bg-red-500'
                            }`"
                        />
                        <span class="tw-ml-2">{{ label }}</span>
                    </div>
                </div>
            </div>
            <div class="tw-w-full tw-columns-2" v-else>
                <div
                    v-for="(label, value) in field.options"
                    :key="value"
                    class="tw-flex-auto"
                >
                    <span
                        :class="`tw-inline-block tw-rounded-full tw-w-2 tw-h-2 tw-mr-1 ${
                            optionIsActive(value)
                                ? 'tw-bg-green-500'
                                : 'tw-bg-red-500'
                        }`"
                    />
                    <span>{{ label }}</span>
                </div>
            </div>
        </template>
    </PanelItem>
</template>

<script>
export default {
    props: ["index", "resource", "resourceName", "resourceId", "field"],

    methods: {
        optionIsActive(option) {
            if (!this.field.value) {
                return false;
            }

            if (!this.field.withGroup) {
                return this.field.value.includes(option);
            }

            return _.flatMap(this.field.value).includes(option);
        },
    },
};
</script>
