const descriptionSambat = (description, limitText = 500) => ({
    description: null,
    showFull: false,
    needReadMore: null,
    displayText: '',
    limitText: limitText,
    viewer: null,

    init() {
        this.description = description;
        this.needReadMore = description.length > this.limitText;
        this.needReadMore ? this.showLessText() : this.showFullText();
    },
    showFullText() {
        this.displayText = this.description;
        this.showFull = true;
    },
    showLessText() {
        this.displayText = this.description.slice(0, this.limitText) + '...';
        this.showFull = false;
    },
    initViewer(element) {
        if (!this.viewer) {
            this.viewer = new Viewer(element, {
                inline: false,
                zoomRatio: 0.2
            });
        }
    }
});

window.descriptionSambat = descriptionSambat;
