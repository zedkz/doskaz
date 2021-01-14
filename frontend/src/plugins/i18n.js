import VueI18n from 'vue-i18n'


const defaultImpl = VueI18n.prototype.getChoiceIndex

/**
 * @param choice {number} a choice index given by the input to $tc: `$tc('path.to.rule', choiceIndex)`
 * @param choicesLength {number} an overall amount of available choices
 * @returns a final choice index to select plural word by
 **/
VueI18n.prototype.getChoiceIndex = function (choice, choicesLength) {
    // this === VueI18n instance, so the locale property also exists here
    if (this.locale !== 'ru') {
        // proceed to the default implementation
        return defaultImpl.apply(this, arguments)
    }

    if (choice === 0) {
        return 0;
    }

    const teen = choice > 10 && choice < 20;
    const endsWithOne = choice % 10 === 1;

    if (!teen && endsWithOne) {
        return 1;
    }

    if (!teen && choice % 10 >= 2 && choice % 10 <= 4) {
        return 2;
    }

    return (choicesLength < 4) ? 2 : 3;
}


export default function ({ app }) {
    app.i18n.onLanguageSwitched = (oldLocale, newLocale) => {
        app.store.dispatch('cities/load')
    }
}