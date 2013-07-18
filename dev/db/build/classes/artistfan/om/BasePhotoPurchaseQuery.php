<?php


/**
 * Base class that represents a query for the 'photo_purchase' table.
 *
 * 
 *
 * @method     PhotoPurchaseQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     PhotoPurchaseQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     PhotoPurchaseQuery orderByPhotoId($order = Criteria::ASC) Order by the photo_id column
 * @method     PhotoPurchaseQuery orderByWithAllAlbum($order = Criteria::ASC) Order by the with_all_album column
 * @method     PhotoPurchaseQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     PhotoPurchaseQuery orderByIsDelete($order = Criteria::ASC) Order by the is_delete column
 * @method     PhotoPurchaseQuery orderByPdate($order = Criteria::ASC) Order by the pdate column
 *
 * @method     PhotoPurchaseQuery groupById() Group by the id column
 * @method     PhotoPurchaseQuery groupByUserId() Group by the user_id column
 * @method     PhotoPurchaseQuery groupByPhotoId() Group by the photo_id column
 * @method     PhotoPurchaseQuery groupByWithAllAlbum() Group by the with_all_album column
 * @method     PhotoPurchaseQuery groupByPrice() Group by the price column
 * @method     PhotoPurchaseQuery groupByIsDelete() Group by the is_delete column
 * @method     PhotoPurchaseQuery groupByPdate() Group by the pdate column
 *
 * @method     PhotoPurchaseQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     PhotoPurchaseQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     PhotoPurchaseQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     PhotoPurchaseQuery leftJoinPhoto($relationAlias = null) Adds a LEFT JOIN clause to the query using the Photo relation
 * @method     PhotoPurchaseQuery rightJoinPhoto($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Photo relation
 * @method     PhotoPurchaseQuery innerJoinPhoto($relationAlias = null) Adds a INNER JOIN clause to the query using the Photo relation
 *
 * @method     PhotoPurchase findOne(PropelPDO $con = null) Return the first PhotoPurchase matching the query
 * @method     PhotoPurchase findOneOrCreate(PropelPDO $con = null) Return the first PhotoPurchase matching the query, or a new PhotoPurchase object populated from the query conditions when no match is found
 *
 * @method     PhotoPurchase findOneById(int $id) Return the first PhotoPurchase filtered by the id column
 * @method     PhotoPurchase findOneByUserId(int $user_id) Return the first PhotoPurchase filtered by the user_id column
 * @method     PhotoPurchase findOneByPhotoId(int $photo_id) Return the first PhotoPurchase filtered by the photo_id column
 * @method     PhotoPurchase findOneByWithAllAlbum(int $with_all_album) Return the first PhotoPurchase filtered by the with_all_album column
 * @method     PhotoPurchase findOneByPrice(double $price) Return the first PhotoPurchase filtered by the price column
 * @method     PhotoPurchase findOneByIsDelete(int $is_delete) Return the first PhotoPurchase filtered by the is_delete column
 * @method     PhotoPurchase findOneByPdate(int $pdate) Return the first PhotoPurchase filtered by the pdate column
 *
 * @method     array findById(int $id) Return PhotoPurchase objects filtered by the id column
 * @method     array findByUserId(int $user_id) Return PhotoPurchase objects filtered by the user_id column
 * @method     array findByPhotoId(int $photo_id) Return PhotoPurchase objects filtered by the photo_id column
 * @method     array findByWithAllAlbum(int $with_all_album) Return PhotoPurchase objects filtered by the with_all_album column
 * @method     array findByPrice(double $price) Return PhotoPurchase objects filtered by the price column
 * @method     array findByIsDelete(int $is_delete) Return PhotoPurchase objects filtered by the is_delete column
 * @method     array findByPdate(int $pdate) Return PhotoPurchase objects filtered by the pdate column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BasePhotoPurchaseQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BasePhotoPurchaseQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'PhotoPurchase', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new PhotoPurchaseQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    PhotoPurchaseQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof PhotoPurchaseQuery) {
			return $criteria;
		}
		$query = new PhotoPurchaseQuery();
		if (null !== $modelAlias) {
			$query->setModelAlias($modelAlias);
		}
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

	/**
	 * Find object by primary key.
	 * Propel uses the instance pool to skip the database if the object exists.
	 * Go fast if the query is untouched.
	 *
	 * <code>
	 * $obj  = $c->findPk(12, $con);
	 * </code>
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    PhotoPurchase|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = PhotoPurchasePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(PhotoPurchasePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$this->basePreSelect($con);
		if ($this->formatter || $this->modelAlias || $this->with || $this->select
		 || $this->selectColumns || $this->asColumns || $this->selectModifiers
		 || $this->map || $this->having || $this->joins) {
			return $this->findPkComplex($key, $con);
		} else {
			return $this->findPkSimple($key, $con);
		}
	}

	/**
	 * Find object by primary key using raw SQL to go fast.
	 * Bypass doSelect() and the object formatter by using generated code.
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con A connection object
	 *
	 * @return    PhotoPurchase A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `USER_ID`, `PHOTO_ID`, `WITH_ALL_ALBUM`, `PRICE`, `IS_DELETE`, `PDATE` FROM `photo_purchase` WHERE `ID` = :p0';
		try {
			$stmt = $con->prepare($sql);
			$stmt->bindValue(':p0', $key, PDO::PARAM_INT);
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
		}
		$obj = null;
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$obj = new PhotoPurchase();
			$obj->hydrate($row);
			PhotoPurchasePeer::addInstanceToPool($obj, (string) $row[0]);
		}
		$stmt->closeCursor();

		return $obj;
	}

	/**
	 * Find object by primary key.
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con A connection object
	 *
	 * @return    PhotoPurchase|array|mixed the result, formatted by the current formatter
	 */
	protected function findPkComplex($key, $con)
	{
		// As the query uses a PK condition, no limit(1) is necessary.
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		$stmt = $criteria
			->filterByPrimaryKey($key)
			->doSelect($con);
		return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
	}

	/**
	 * Find objects by primary key
	 * <code>
	 * $objs = $c->findPks(array(12, 56, 832), $con);
	 * </code>
	 * @param     array $keys Primary keys to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    PropelObjectCollection|array|mixed the list of results, formatted by the current formatter
	 */
	public function findPks($keys, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
		}
		$this->basePreSelect($con);
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		$stmt = $criteria
			->filterByPrimaryKeys($keys)
			->doSelect($con);
		return $criteria->getFormatter()->init($criteria)->format($stmt);
	}

	/**
	 * Filter the query by primary key
	 *
	 * @param     mixed $key Primary key to use for the query
	 *
	 * @return    PhotoPurchaseQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(PhotoPurchasePeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    PhotoPurchaseQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(PhotoPurchasePeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterById(1234); // WHERE id = 1234
	 * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
	 * $query->filterById(array('min' => 12)); // WHERE id > 12
	 * </code>
	 *
	 * @param     mixed $id The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PhotoPurchaseQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(PhotoPurchasePeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the user_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByUserId(1234); // WHERE user_id = 1234
	 * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
	 * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
	 * </code>
	 *
	 * @param     mixed $userId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PhotoPurchaseQuery The current query, for fluid interface
	 */
	public function filterByUserId($userId = null, $comparison = null)
	{
		if (is_array($userId)) {
			$useMinMax = false;
			if (isset($userId['min'])) {
				$this->addUsingAlias(PhotoPurchasePeer::USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($userId['max'])) {
				$this->addUsingAlias(PhotoPurchasePeer::USER_ID, $userId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PhotoPurchasePeer::USER_ID, $userId, $comparison);
	}

	/**
	 * Filter the query on the photo_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPhotoId(1234); // WHERE photo_id = 1234
	 * $query->filterByPhotoId(array(12, 34)); // WHERE photo_id IN (12, 34)
	 * $query->filterByPhotoId(array('min' => 12)); // WHERE photo_id > 12
	 * </code>
	 *
	 * @see       filterByPhoto()
	 *
	 * @param     mixed $photoId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PhotoPurchaseQuery The current query, for fluid interface
	 */
	public function filterByPhotoId($photoId = null, $comparison = null)
	{
		if (is_array($photoId)) {
			$useMinMax = false;
			if (isset($photoId['min'])) {
				$this->addUsingAlias(PhotoPurchasePeer::PHOTO_ID, $photoId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($photoId['max'])) {
				$this->addUsingAlias(PhotoPurchasePeer::PHOTO_ID, $photoId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PhotoPurchasePeer::PHOTO_ID, $photoId, $comparison);
	}

	/**
	 * Filter the query on the with_all_album column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByWithAllAlbum(1234); // WHERE with_all_album = 1234
	 * $query->filterByWithAllAlbum(array(12, 34)); // WHERE with_all_album IN (12, 34)
	 * $query->filterByWithAllAlbum(array('min' => 12)); // WHERE with_all_album > 12
	 * </code>
	 *
	 * @param     mixed $withAllAlbum The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PhotoPurchaseQuery The current query, for fluid interface
	 */
	public function filterByWithAllAlbum($withAllAlbum = null, $comparison = null)
	{
		if (is_array($withAllAlbum)) {
			$useMinMax = false;
			if (isset($withAllAlbum['min'])) {
				$this->addUsingAlias(PhotoPurchasePeer::WITH_ALL_ALBUM, $withAllAlbum['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($withAllAlbum['max'])) {
				$this->addUsingAlias(PhotoPurchasePeer::WITH_ALL_ALBUM, $withAllAlbum['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PhotoPurchasePeer::WITH_ALL_ALBUM, $withAllAlbum, $comparison);
	}

	/**
	 * Filter the query on the price column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPrice(1234); // WHERE price = 1234
	 * $query->filterByPrice(array(12, 34)); // WHERE price IN (12, 34)
	 * $query->filterByPrice(array('min' => 12)); // WHERE price > 12
	 * </code>
	 *
	 * @param     mixed $price The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PhotoPurchaseQuery The current query, for fluid interface
	 */
	public function filterByPrice($price = null, $comparison = null)
	{
		if (is_array($price)) {
			$useMinMax = false;
			if (isset($price['min'])) {
				$this->addUsingAlias(PhotoPurchasePeer::PRICE, $price['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($price['max'])) {
				$this->addUsingAlias(PhotoPurchasePeer::PRICE, $price['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PhotoPurchasePeer::PRICE, $price, $comparison);
	}

	/**
	 * Filter the query on the is_delete column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByIsDelete(1234); // WHERE is_delete = 1234
	 * $query->filterByIsDelete(array(12, 34)); // WHERE is_delete IN (12, 34)
	 * $query->filterByIsDelete(array('min' => 12)); // WHERE is_delete > 12
	 * </code>
	 *
	 * @param     mixed $isDelete The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PhotoPurchaseQuery The current query, for fluid interface
	 */
	public function filterByIsDelete($isDelete = null, $comparison = null)
	{
		if (is_array($isDelete)) {
			$useMinMax = false;
			if (isset($isDelete['min'])) {
				$this->addUsingAlias(PhotoPurchasePeer::IS_DELETE, $isDelete['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($isDelete['max'])) {
				$this->addUsingAlias(PhotoPurchasePeer::IS_DELETE, $isDelete['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PhotoPurchasePeer::IS_DELETE, $isDelete, $comparison);
	}

	/**
	 * Filter the query on the pdate column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPdate(1234); // WHERE pdate = 1234
	 * $query->filterByPdate(array(12, 34)); // WHERE pdate IN (12, 34)
	 * $query->filterByPdate(array('min' => 12)); // WHERE pdate > 12
	 * </code>
	 *
	 * @param     mixed $pdate The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PhotoPurchaseQuery The current query, for fluid interface
	 */
	public function filterByPdate($pdate = null, $comparison = null)
	{
		if (is_array($pdate)) {
			$useMinMax = false;
			if (isset($pdate['min'])) {
				$this->addUsingAlias(PhotoPurchasePeer::PDATE, $pdate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($pdate['max'])) {
				$this->addUsingAlias(PhotoPurchasePeer::PDATE, $pdate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PhotoPurchasePeer::PDATE, $pdate, $comparison);
	}

	/**
	 * Filter the query by a related Photo object
	 *
	 * @param     Photo|PropelCollection $photo The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PhotoPurchaseQuery The current query, for fluid interface
	 */
	public function filterByPhoto($photo, $comparison = null)
	{
		if ($photo instanceof Photo) {
			return $this
				->addUsingAlias(PhotoPurchasePeer::PHOTO_ID, $photo->getId(), $comparison);
		} elseif ($photo instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(PhotoPurchasePeer::PHOTO_ID, $photo->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByPhoto() only accepts arguments of type Photo or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Photo relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    PhotoPurchaseQuery The current query, for fluid interface
	 */
	public function joinPhoto($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Photo');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'Photo');
		}

		return $this;
	}

	/**
	 * Use the Photo relation Photo object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    PhotoQuery A secondary query class using the current class as primary query
	 */
	public function usePhotoQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinPhoto($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Photo', 'PhotoQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     PhotoPurchase $photoPurchase Object to remove from the list of results
	 *
	 * @return    PhotoPurchaseQuery The current query, for fluid interface
	 */
	public function prune($photoPurchase = null)
	{
		if ($photoPurchase) {
			$this->addUsingAlias(PhotoPurchasePeer::ID, $photoPurchase->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BasePhotoPurchaseQuery