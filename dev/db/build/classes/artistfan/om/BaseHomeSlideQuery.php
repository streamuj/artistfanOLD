<?php


/**
 * Base class that represents a query for the 'home_slide' table.
 *
 * 
 *
 * @method     HomeSlideQuery orderByHsId($order = Criteria::ASC) Order by the hs_id column
 * @method     HomeSlideQuery orderByHsImage($order = Criteria::ASC) Order by the hs_image column
 * @method     HomeSlideQuery orderByHsOrder($order = Criteria::ASC) Order by the hs_order column
 * @method     HomeSlideQuery orderByHsStatus($order = Criteria::ASC) Order by the hs_status column
 * @method     HomeSlideQuery orderByCreatedOn($order = Criteria::ASC) Order by the created_on column
 * @method     HomeSlideQuery orderByCreatedBy($order = Criteria::ASC) Order by the created_by column
 * @method     HomeSlideQuery orderByModifiedOn($order = Criteria::ASC) Order by the modified_on column
 * @method     HomeSlideQuery orderByModifiedBy($order = Criteria::ASC) Order by the modified_by column
 * @method     HomeSlideQuery orderByHsLink($order = Criteria::ASC) Order by the hs_link column
 *
 * @method     HomeSlideQuery groupByHsId() Group by the hs_id column
 * @method     HomeSlideQuery groupByHsImage() Group by the hs_image column
 * @method     HomeSlideQuery groupByHsOrder() Group by the hs_order column
 * @method     HomeSlideQuery groupByHsStatus() Group by the hs_status column
 * @method     HomeSlideQuery groupByCreatedOn() Group by the created_on column
 * @method     HomeSlideQuery groupByCreatedBy() Group by the created_by column
 * @method     HomeSlideQuery groupByModifiedOn() Group by the modified_on column
 * @method     HomeSlideQuery groupByModifiedBy() Group by the modified_by column
 * @method     HomeSlideQuery groupByHsLink() Group by the hs_link column
 *
 * @method     HomeSlideQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     HomeSlideQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     HomeSlideQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     HomeSlide findOne(PropelPDO $con = null) Return the first HomeSlide matching the query
 * @method     HomeSlide findOneOrCreate(PropelPDO $con = null) Return the first HomeSlide matching the query, or a new HomeSlide object populated from the query conditions when no match is found
 *
 * @method     HomeSlide findOneByHsId(int $hs_id) Return the first HomeSlide filtered by the hs_id column
 * @method     HomeSlide findOneByHsImage(string $hs_image) Return the first HomeSlide filtered by the hs_image column
 * @method     HomeSlide findOneByHsOrder(int $hs_order) Return the first HomeSlide filtered by the hs_order column
 * @method     HomeSlide findOneByHsStatus(int $hs_status) Return the first HomeSlide filtered by the hs_status column
 * @method     HomeSlide findOneByCreatedOn(int $created_on) Return the first HomeSlide filtered by the created_on column
 * @method     HomeSlide findOneByCreatedBy(int $created_by) Return the first HomeSlide filtered by the created_by column
 * @method     HomeSlide findOneByModifiedOn(int $modified_on) Return the first HomeSlide filtered by the modified_on column
 * @method     HomeSlide findOneByModifiedBy(int $modified_by) Return the first HomeSlide filtered by the modified_by column
 * @method     HomeSlide findOneByHsLink(string $hs_link) Return the first HomeSlide filtered by the hs_link column
 *
 * @method     array findByHsId(int $hs_id) Return HomeSlide objects filtered by the hs_id column
 * @method     array findByHsImage(string $hs_image) Return HomeSlide objects filtered by the hs_image column
 * @method     array findByHsOrder(int $hs_order) Return HomeSlide objects filtered by the hs_order column
 * @method     array findByHsStatus(int $hs_status) Return HomeSlide objects filtered by the hs_status column
 * @method     array findByCreatedOn(int $created_on) Return HomeSlide objects filtered by the created_on column
 * @method     array findByCreatedBy(int $created_by) Return HomeSlide objects filtered by the created_by column
 * @method     array findByModifiedOn(int $modified_on) Return HomeSlide objects filtered by the modified_on column
 * @method     array findByModifiedBy(int $modified_by) Return HomeSlide objects filtered by the modified_by column
 * @method     array findByHsLink(string $hs_link) Return HomeSlide objects filtered by the hs_link column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseHomeSlideQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseHomeSlideQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'HomeSlide', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new HomeSlideQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    HomeSlideQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof HomeSlideQuery) {
			return $criteria;
		}
		$query = new HomeSlideQuery();
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
	 * @return    HomeSlide|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = HomeSlidePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(HomeSlidePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    HomeSlide A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `HS_ID`, `HS_IMAGE`, `HS_ORDER`, `HS_STATUS`, `CREATED_ON`, `CREATED_BY`, `MODIFIED_ON`, `MODIFIED_BY`, `HS_LINK`, `HS_NEW` FROM `home_slide` WHERE `HS_ID` = :p0';
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
			$obj = new HomeSlide();
			$obj->hydrate($row);
			HomeSlidePeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    HomeSlide|array|mixed the result, formatted by the current formatter
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
	 * @return    HomeSlideQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(HomeSlidePeer::HS_ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    HomeSlideQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(HomeSlidePeer::HS_ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the hs_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByHsId(1234); // WHERE hs_id = 1234
	 * $query->filterByHsId(array(12, 34)); // WHERE hs_id IN (12, 34)
	 * $query->filterByHsId(array('min' => 12)); // WHERE hs_id > 12
	 * </code>
	 *
	 * @param     mixed $hsId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    HomeSlideQuery The current query, for fluid interface
	 */
	public function filterByHsId($hsId = null, $comparison = null)
	{
		if (is_array($hsId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(HomeSlidePeer::HS_ID, $hsId, $comparison);
	}

	/**
	 * Filter the query on the hs_image column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByHsImage('fooValue');   // WHERE hs_image = 'fooValue'
	 * $query->filterByHsImage('%fooValue%'); // WHERE hs_image LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $hsImage The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    HomeSlideQuery The current query, for fluid interface
	 */
	public function filterByHsImage($hsImage = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($hsImage)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $hsImage)) {
				$hsImage = str_replace('*', '%', $hsImage);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(HomeSlidePeer::HS_IMAGE, $hsImage, $comparison);
	}

	/**
	 * Filter the query on the hs_order column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByHsOrder(1234); // WHERE hs_order = 1234
	 * $query->filterByHsOrder(array(12, 34)); // WHERE hs_order IN (12, 34)
	 * $query->filterByHsOrder(array('min' => 12)); // WHERE hs_order > 12
	 * </code>
	 *
	 * @param     mixed $hsOrder The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    HomeSlideQuery The current query, for fluid interface
	 */
	public function filterByHsOrder($hsOrder = null, $comparison = null)
	{
		if (is_array($hsOrder)) {
			$useMinMax = false;
			if (isset($hsOrder['min'])) {
				$this->addUsingAlias(HomeSlidePeer::HS_ORDER, $hsOrder['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($hsOrder['max'])) {
				$this->addUsingAlias(HomeSlidePeer::HS_ORDER, $hsOrder['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(HomeSlidePeer::HS_ORDER, $hsOrder, $comparison);
	}

	/**
	 * Filter the query on the hs_status column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByHsStatus(1234); // WHERE hs_status = 1234
	 * $query->filterByHsStatus(array(12, 34)); // WHERE hs_status IN (12, 34)
	 * $query->filterByHsStatus(array('min' => 12)); // WHERE hs_status > 12
	 * </code>
	 *
	 * @param     mixed $hsStatus The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    HomeSlideQuery The current query, for fluid interface
	 */
	public function filterByHsStatus($hsStatus = null, $comparison = null)
	{
		if (is_array($hsStatus)) {
			$useMinMax = false;
			if (isset($hsStatus['min'])) {
				$this->addUsingAlias(HomeSlidePeer::HS_STATUS, $hsStatus['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($hsStatus['max'])) {
				$this->addUsingAlias(HomeSlidePeer::HS_STATUS, $hsStatus['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(HomeSlidePeer::HS_STATUS, $hsStatus, $comparison);
	}

	/**
	 * Filter the query on the created_on column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCreatedOn(1234); // WHERE created_on = 1234
	 * $query->filterByCreatedOn(array(12, 34)); // WHERE created_on IN (12, 34)
	 * $query->filterByCreatedOn(array('min' => 12)); // WHERE created_on > 12
	 * </code>
	 *
	 * @param     mixed $createdOn The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    HomeSlideQuery The current query, for fluid interface
	 */
	public function filterByCreatedOn($createdOn = null, $comparison = null)
	{
		if (is_array($createdOn)) {
			$useMinMax = false;
			if (isset($createdOn['min'])) {
				$this->addUsingAlias(HomeSlidePeer::CREATED_ON, $createdOn['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($createdOn['max'])) {
				$this->addUsingAlias(HomeSlidePeer::CREATED_ON, $createdOn['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(HomeSlidePeer::CREATED_ON, $createdOn, $comparison);
	}

	/**
	 * Filter the query on the created_by column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCreatedBy(1234); // WHERE created_by = 1234
	 * $query->filterByCreatedBy(array(12, 34)); // WHERE created_by IN (12, 34)
	 * $query->filterByCreatedBy(array('min' => 12)); // WHERE created_by > 12
	 * </code>
	 *
	 * @param     mixed $createdBy The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    HomeSlideQuery The current query, for fluid interface
	 */
	public function filterByCreatedBy($createdBy = null, $comparison = null)
	{
		if (is_array($createdBy)) {
			$useMinMax = false;
			if (isset($createdBy['min'])) {
				$this->addUsingAlias(HomeSlidePeer::CREATED_BY, $createdBy['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($createdBy['max'])) {
				$this->addUsingAlias(HomeSlidePeer::CREATED_BY, $createdBy['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(HomeSlidePeer::CREATED_BY, $createdBy, $comparison);
	}

	/**
	 * Filter the query on the modified_on column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByModifiedOn(1234); // WHERE modified_on = 1234
	 * $query->filterByModifiedOn(array(12, 34)); // WHERE modified_on IN (12, 34)
	 * $query->filterByModifiedOn(array('min' => 12)); // WHERE modified_on > 12
	 * </code>
	 *
	 * @param     mixed $modifiedOn The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    HomeSlideQuery The current query, for fluid interface
	 */
	public function filterByModifiedOn($modifiedOn = null, $comparison = null)
	{
		if (is_array($modifiedOn)) {
			$useMinMax = false;
			if (isset($modifiedOn['min'])) {
				$this->addUsingAlias(HomeSlidePeer::MODIFIED_ON, $modifiedOn['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($modifiedOn['max'])) {
				$this->addUsingAlias(HomeSlidePeer::MODIFIED_ON, $modifiedOn['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(HomeSlidePeer::MODIFIED_ON, $modifiedOn, $comparison);
	}

	/**
	 * Filter the query on the modified_by column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByModifiedBy(1234); // WHERE modified_by = 1234
	 * $query->filterByModifiedBy(array(12, 34)); // WHERE modified_by IN (12, 34)
	 * $query->filterByModifiedBy(array('min' => 12)); // WHERE modified_by > 12
	 * </code>
	 *
	 * @param     mixed $modifiedBy The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    HomeSlideQuery The current query, for fluid interface
	 */
	public function filterByModifiedBy($modifiedBy = null, $comparison = null)
	{
		if (is_array($modifiedBy)) {
			$useMinMax = false;
			if (isset($modifiedBy['min'])) {
				$this->addUsingAlias(HomeSlidePeer::MODIFIED_BY, $modifiedBy['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($modifiedBy['max'])) {
				$this->addUsingAlias(HomeSlidePeer::MODIFIED_BY, $modifiedBy['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(HomeSlidePeer::MODIFIED_BY, $modifiedBy, $comparison);
	}

	/**
	 * Filter the query on the hs_link column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByHsLink('fooValue');   // WHERE hs_link = 'fooValue'
	 * $query->filterByHsLink('%fooValue%'); // WHERE hs_link LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $hsLink The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    HomeSlideQuery The current query, for fluid interface
	 */
	public function filterByHsLink($hsLink = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($hsLink)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $hsLink)) {
				$hsLink = str_replace('*', '%', $hsLink);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(HomeSlidePeer::HS_LINK, $hsLink, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     HomeSlide $homeSlide Object to remove from the list of results
	 *
	 * @return    HomeSlideQuery The current query, for fluid interface
	 */
	public function prune($homeSlide = null)
	{
		if ($homeSlide) {
			$this->addUsingAlias(HomeSlidePeer::HS_ID, $homeSlide->getHsId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseHomeSlideQuery