<?php

/**
 * Class View_Metabox
 */
class View_Metabox extends FormView {
	/**
	 * @var string
	 */
	protected $class = "form-inline";

	/**
	 * @param Element $element
	 */
	public function renderElement( $element ) {
		if ( $element instanceof Element_Hidden || $element instanceof Element_HTML || $element instanceof Element_Button ) {
			$element->render();

			return;
		}


//		if ( ! $element instanceof Element_Radio && ! $element instanceof Element_Checkbox && ! $element instanceof Element_File ) {
//			$element->appendAttribute( "class", "form-control" );
//		}

		if ( $this->noLabel ) {
			$label = $element->getLabel();
			$element->setAttribute( "placeholder", $label );
			$element->setLabel( "" );
		}

		echo '<div class="bf_field_group elem-' . $element->getAttribute( "id" ) . '"> ', $this->renderLabel( $element );
		echo '<div class="bf-input">';
		echo $element->render();
		echo $this->renderDescriptions( $element );
		echo "</div></div>";

	}

	/**
	 * @param Element $element
	 */
	protected function renderLabel( Element $element ) {
		$label = $element->getLabel();
		if ( empty ( $label ) ) {
			$label = '';
		}
		echo '<div class="bf-label"><label for="', $element->getAttribute( "id" ), '">';
		if ( $element->isRequired() ) {
			echo '&nbsp;<span class="required">* </span> ';
		}
		echo $label, '</label></div> ';


		$label = $element->getLabel();

		//TODO improve required flag position
		if ( $element->isRequired() ) {
			$label = $label . $this->renderRequired();
		}

		echo sprintf('<div class="bf-label"><label for="%s">%s</label></div>', $element->getAttribute( "id" ), $label);
	}
}
