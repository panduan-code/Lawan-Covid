/**
 * WordPress dependencies
 */
const {
	Component,
} = wp.element;

const {
    InnerBlocks,
} = wp.editor;

/**
 * Component
 */
export default class SectionBlockSave extends Component {
	render() {
		const className = 'cnvs-block-section-content';

        return <InnerBlocks.Content />;
    }
}
