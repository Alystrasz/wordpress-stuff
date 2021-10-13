/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

import { useSelect } from '@wordpress/data';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-block-editor/#useBlockProps
 */
import { useBlockProps } from '@wordpress/block-editor';


/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */
export default function Edit() {
	const posts = useSelect( ( select ) => {
		return select( 'core' ).getEntityRecords( 'postType', 'post' );
	}, [] );

	const postsCount = 3;

	if (!posts) {
		return (
			<p { ...useBlockProps() }>
				{ ! posts && 'Loading' }
			</p>
		);
	}

	if (posts && posts.length === 0) {
		return (
			<p { ...useBlockProps() }>
				{ posts && posts.length === 0 && 'No Posts' }
			</p>
		);
	}

	
	const carouselItems = [];
	const carouselIndicators = []; // TODO

	for (let i=0; i<postsCount; i++) {
		const post = posts[i];

		carouselIndicators.push(
			<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to={i} aria-label={"Slide " + (i+1)}></button>
		);

		carouselItems.push( 
			<div class="carousel-item">
				<img src="https://via.placeholder.com/800x400" class="d-block w-100" alt="..."/>
				<div class="carousel-caption d-none d-md-block">
					<h5>{ post.title.raw }</h5>
					<p>{ post.excerpt.raw }</p>
				</div>
			</div>
		);
	}

	// showing first carousel item by default
	carouselItems[0].props.class += ' active';
	carouselIndicators[0].props.class = 'active';
	carouselIndicators[0].props['aria-current'] = 'true';

	return (
		<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" { ...useBlockProps() }>
			<div class="carousel-indicators">
				{ carouselIndicators }
			</div>
			<div class="carousel-inner">
				{ carouselItems }
			</div>
			<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Previous</span>
			</button>
			<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Next</span>
			</button>
		</div>
	);
}
