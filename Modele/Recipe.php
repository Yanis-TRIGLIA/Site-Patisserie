<?php

/**
 * Object representing a recipe through database
 */
final class Recipe extends DbObject {

    private static $reqManager;

    static function init() {
        self::$reqManager = new RequestsManager('RECIPE');
        self::$reqManager->add('select_row', 'SELECT * FROM RECIPE WHERE ID_RECIPE=?');
        self::$reqManager->add('select_ustensils', 'SELECT * FROM RECIPE_USTENSIL WHERE ID_RECIPE=?');
        self::$reqManager->add('select_ingredients', 'SELECT * FROM RECIPE_INGREDIENT WHERE ID_RECIPE=?');

		self::$reqManager->add('insert_row', 'INSERT INTO RECIPE (NAME, DESCRIPTION, DURATION, ID_AUTHOR, ID_DIFFICULTY, ID_COST, IMAGE_URL) VALUES (?, ?, ?, ?, ?, ?, ?)');
        self::$reqManager->add('insert_ustensil', 'INSERT INTO RECIPE_USTENSIL (ID_RECIPE, ID_USTENSIL) VALUES (?, ?)');
        self::$reqManager->add('insert_ingredient', 'INSERT INTO RECIPE_INGREDIENT (ID_RECIPE, ID_INGREDIENT, QUANTITY) VALUES (?, ?, ?)');

		self::$reqManager->add('update_row', 'UPDATE RECIPE SET NAME=?, DESCRIPTION=?, DURATION=?, ID_AUTHOR=?, ID_DIFFICULTY=?, ID_COST=?, IMAGE_URL=? WHERE ID_RECIPE=?');

		self::$reqManager->add('delete_row', 'DELETE FROM RECIPE WHERE ID_RECIPE=?');
        self::$reqManager->add('delete_ustensil', 'DELETE FROM RECIPE_USTENSIL WHERE ID_RECIPE=? AND ID_USTENSIL=?');
        self::$reqManager->add('delete_ustensils', 'DELETE FROM RECIPE_USTENSIL WHERE ID_RECIPE=?');
        self::$reqManager->add('delete_ingredient', 'DELETE FROM RECIPE_INGREDIENT WHERE ID_RECIPE=? AND ID_INGREDIENT=?');
        self::$reqManager->add('delete_ingredients', 'DELETE FROM RECIPE_INGREDIENT WHERE ID_RECIPE=?');
        self::$reqManager->add('delete_appreciations', 'DELETE FROM APPRECIATION WHERE ID_RECIPE=?');
    }
    
    /**
	 * Get all the existing recipes
	 * @return array An array containing all recipes
	 */
	public static function getAll() {
		$req_output = self::$reqManager->execute('*');
		$all_recipes = array();
        while ($attr = $req_output->fetch()) {
            $ustensils = array();
            $ustensilsAttr = self::$reqManager->execute('select_ustensils', array($attr['ID_RECIPE']));
            while ($ustensilAttr = $ustensilsAttr->fetch())
                array_push($ustensils, Ustensil::getById($ustensilAttr['ID_USTENSIL']));
            $ingredients = array();
            $ingredientsAttr = self::$reqManager->execute('select_ingredients', array($attr['ID_RECIPE']));
            while ($ingredientAttr = $ingredientsAttr->fetch())
                array_push($ingredients, new IngredientRecipe(Ingredient::getById($ingredientAttr['ID_INGREDIENT']), $ingredientAttr['QUANTITY']));
            array_push($all_recipes, new Recipe($attr['ID_RECIPE'], $attr['NAME'], explode('\n', $attr['DESCRIPTION']), $attr['DURATION'], User::getById($attr['ID_AUTHOR']), Difficulty::getById($attr['ID_DIFFICULTY']), Cost::getById($attr['ID_COST']), $ustensils, $ingredients, Appreciation::getByRecipeId($attr['ID_RECIPE']), $attr['IMAGE_URL']));
        }
		return $all_recipes;
	}

	/**
	 * Get the recipe associated to the given id
	 * @param int $id The given id
	 * @return Recipe The recipe associated to the id
	 */
    public static function getById($id) {
        $ustensils = array();
        $ustensilsAttr = self::$reqManager->execute('select_ustensils', array($id));
        while ($ustensilAttr = $ustensilsAttr->fetch())
            array_push($ustensils, Ustensil::getById($ustensilAttr['ID_USTENSIL']));
        $ingredients = array();
        $ingredientsAttr = self::$reqManager->execute('select_ingredients', array($id));
        while ($ingredientAttr = $ingredientsAttr->fetch())
            array_push($ingredients, new IngredientRecipe(Ingredient::getById($ingredientAttr['ID_INGREDIENT']), $ingredientAttr['QUANTITY']));
        $attr = self::$reqManager->execute('select_row', array($id))->fetch();
        return new Recipe($attr['ID_RECIPE'], $attr['NAME'], explode('\n', $attr['DESCRIPTION']), $attr['DURATION'], User::getById($attr['ID_AUTHOR']), Difficulty::getById($attr['ID_DIFFICULTY']), Cost::getById($attr['ID_COST']), $ustensils, $ingredients, Appreciation::getByRecipeId($attr['ID_RECIPE']), $attr['IMAGE_URL']);
    }

    private $description;
    private $duration;
    private $author;
    private $difficulty;
    private $cost;
    private $ustensils;
    private $ingredients;
    private $appreciations;
    private $imageUrl;

    public function __construct(
        ?int $id, $name, $description, $duration, $author, $difficulty, $cost,
        $ustensils, $ingredients, $appreciations, $imageUrl
    ) {
        parent::__construct($id, $name);
        $this->description= $description;
        $this->duration= $duration;
        $this->author = $author;
        $this->difficulty = $difficulty;
        $this->cost = $cost;
        $this->ustensils = $ustensils;
        $this->ingredients = $ingredients;
        $this->appreciations = $appreciations;
        $this->imageUrl = $imageUrl;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getDuration() {
        return $this->duration;
    }

    public function setDuration($duration) {
        $this->duration = $duration;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }

    public function getDifficulty() {
        return $this->difficulty;
    }

    public function setDifficulty($difficulty) {
        $this->difficulty = $difficulty;
    }

    public function getCost() {
        return $this->cost;
    }

    public function setCost($cost) {
        $this->cost = $cost;
    }

    public function getUstensils() {
        return $this->ustensils;
    }

    public function setUstensils($ustensils) {
        $this->ustensils = $ustensils;
    }

    public function getIngredients() {
        return $this->ingredients;
    }

    public function setIngredients($ingredients) {
        $this->ingredients = $ingredients;
    }

    public function getAppreciations() {
        return $this->appreciations;
    }

    public function setAppreciations($appreciations) {
        $this->appreciations = $appreciations;
    }

    public function addAppreciation($appreciation) {
        $appreciation->setIdRecipe($this->getId());
        array_push($this->appreciations, $appreciation);
    }

    public function getImageUrl() {
        return $this->imageUrl;
    }

    public function setImageUrl($imageUrl) {
        $this->imageUrl = $imageUrl;
    }

    /**
	 * Insert **this** Recipe in the database
	 * It also set **this** id to the given auto-incremented id in database
	 * @return void
	 */
	public function insert() {
		self::$reqManager->execute('insert_row', array($this->getName(), implode('\n', $this->getDescription()), $this->getDuration(), $this->getAuthor()->getId(), $this->getDifficulty()->getId(), $this->getCost()->getId(), $this->getImageUrl()));
		$this->setId(modele::$pdo->lastInsertId());
        foreach ($this->getUstensils() as $ustensil)
            self::$reqManager->execute('insert_ustensil', array($this->getId(), $ustensil->getId()));
        foreach ($this->getIngredients() as $ingredient)
            self::$reqManager->execute('insert_ingredient', array($this->getId(), $ingredient->getIngredient()->getId(), $ingredient->getQuantity()));
        foreach ($this->getAppreciations() as $appreciation) {
            $appreciation->setIdRecipe($this->getId());
            $appreciation->insert();
        }
	}
	
	/**
	 * Put **this** Recipe attributes in database
	 * @return void
	 */
	public function update() {
        self::$reqManager->execute('update_row', array($this->getName(), implode('\n', $this->getDescription()), $this->getDuration(), $this->getAuthor()->getId(), $this->getDifficulty()->getId(), $this->getCost()->getId(), $this->getImageUrl(), $this->getId()));
        $oldUstencilsId = $this->getDbUstensilsId();
        // adding new ustensils
        foreach ($this->getUstensils() as $newUstensil)
        if (!in_array($newUstensil->getId(), $oldUstencilsId))
                self::$reqManager->execute('insert_ustensil', array($this->getId(), $newUstensil->getId()));
                // removing old ustensils
        foreach ($oldUstencilsId as $oldUstensilId) {
            // manually looking for matching id
            $found = false;
            foreach ($this->getUstensils() as $newUstensil)
                if ($oldUstensilId == $newUstensil->getId()) {
                    $found = true;
                    break;
                }
                if (!$found)
                self::$reqManager->execute('delete_ustensil', array($this->getId(), $oldUstensilId));
        }

        self::$reqManager->execute('delete_ingredients', array($this->getId()));
        foreach ($this->getIngredients() as $ingredient)
            self::$reqManager->execute('insert_ingredient', array($this->getId(), $ingredient->getIngredient()->getId(), $ingredient->getQuantity()));

        self::$reqManager->execute('delete_appreciations', array($this->getId()));
        foreach ($this->getAppreciations() as $appreciation)
            $appreciation->insert();
	}
	
	/**
	 * Put database attributes in **this** Recipe
	 * @return void
	 */
	public function refresh() {
        $attr = self::$reqManager->execute('select_row', array($this->getId()))->fetch();
        $this->setName($attr['NAME']);
        $this->setDescription(explode('\n', $attr['DESCRIPTION']));
        $this->setDuration($attr['DURATION']);
        $this->setAuthor(User::getById($attr['ID_AUTHOR']));
        $this->setDifficulty(Difficulty::getById($attr['ID_DIFFICULTY']));
        $this->setCost(Cost::getById($attr['ID_COST']));

        $ustensils = array();
        $ustensilsAttr = self::$reqManager->execute('select_ustensils', array($this->getId()));
        while ($ustensilAttr = $ustensilsAttr->fetch())
            array_push($ustensils, Ustensil::getById($ustensilAttr['ID_USTENSIL']));
        $this->setUstensils($ustensils);

        $ingredients = array();
        $ingredientsAttr = self::$reqManager->execute('select_ingredients', array($this->getId()));
        while ($ingredientAttr = $ingredientsAttr->fetch())
            array_push($ingredients, new IngredientRecipe(Ingredient::getById($ingredientAttr['ID_INGREDIENT']), $ingredientAttr['QUANTITY']));
        $this->setIngredients($ingredients);

        $this->setAppreciations(Appreciation::getByRecipeId($attr['ID_RECIPE']));
        $this->setImageUrl($attr['IMAGE_URL']);
	}
	
	/**
	 * Delete **this** Recipe in the database
	 * @return void
	 */
	public function delete() {
        self::$reqManager->execute('delete_ustensils', array($this->getId()));
        self::$reqManager->execute('delete_ingredients', array($this->getId()));
        self::$reqManager->execute('delete_appreciations', array($this->getId()));
        self::$reqManager->execute('delete_row', array($this->getId()));
	}

    public function __toString() {
        return __CLASS__ . '{' .
            'parent:' . parent::__toString() .
            ',<br>description=<br>' . implode(',<br>', $this->getDescription()) .
            '<br>duration=' . $this->getDuration() .
            ', author=' . $this->getAuthor() .
            ', difficulty=' . $this->getDifficulty() .
            ', cost=' . $this->getCost() .
            ',<br>ustensils=<br>' . implode(',<br>', $this->getUstensils()) .
            '<br>ingredient=<br>' . implode(',<br>', $this->getIngredients()) .
            '<br>appreciations=<br>' . implode(',<br>', $this->getAppreciations()) .
            '<br>imageUrl=' . $this->getImageUrl() .
            '}';
    }

    private function getDbUstensilsId() {
        $ustensilsId = array();
        $ustensilsAttr = self::$reqManager->execute('select_ustensils', array($this->getId()));
        while ($ustensilAttr = $ustensilsAttr->fetch())
            array_push($ustensilsId, $ustensilAttr['ID_USTENSIL']);
        return $ustensilsId;
    }

    private function getDbIngredientsId() {
        $ingredientsId = array();
        $ingredientsAttr = self::$reqManager->execute('select_ingredients', array($this->getId()));
        while ($ingredientAttr = $ingredientsAttr->fetch())
            array_push($ingredientsId, $ingredientAttr['ID_INGREDIENT']);
        return $ingredientsId;
    }

}

Recipe::init();