<?php


/**
 * Base class that represents a query for the 'adbanner_type' table.
 *
 * 
 *
 * @method     AdbannerTypeQuery orderByAdbtId($order = Criteria::ASC) Order by the adbt_id column
 * @method     AdbannerTypeQuery orderByAdbtName($order = Criteria::ASC) Order by the adbt_name column
 * @method     AdbannerTypeQuery orderByAdbtImgWidth($order = Criteria::ASC) Order by the adbt_img_width column
 * @method     AdbannerTypeQuery orderByAdbtImgHeight($order = Criteria::ASC) Order by the adbt_img_height column
 *
 * @method     AdbannerTypeQuery groupByAdbtId() Group by the adbt_id column
 * @method     AdbannerTypeQuery groupByAdbtName() Group by the adbt_name column
 * @method     AdbannerTypeQuery groupByAdbtImgWidth() Group by the adbt_img_width column
 * @method     AdbannerTypeQuery groupByAdbtImgHeight() Group by the adbt_img_height column
 *
 * @method     AdbannerTypeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     AdbannerTypeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     AdbannerTypeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     AdbannerType findOne(PropelPDO $con = null) Return the first AdbannerType matching the query
 * @method     AdbannerType findOneOrCreate(PropelPDO $con = null) Return the first AdbannerType matching the query, or a new AdbannerType object populated from the query conditions when no match is found
 *
 * @method     AdbannerType findOneByAdbtId(int $adbt_id) Return the first AdbannerType filtered by the adbt_id column
 * @method     AdbannerType findOneByAdbtName(string $adbt_name) Return the first AdbannerType filtered by the adbt_name column
 * @method     AdbannerType findOneByAdbtImgWidth(int $adbt_img_width) Return the first AdbannerType filtered by the adbt_img_width column
 * @method     AdbannerType findOneByAdbtImgHeight(int $adbt_img_height) Return the first AdbannerType filtered by the adbt_img_height column
 *
 * @method     array findByAdbtId(int $adbt_id) Return AdbannerType objects filtered by the adbt_id column
 * @method     array findByAdbtName(string $adbt_name) Return AdbannerType objects filtered by the adbt_name column
 * @method     array findByAdbtImgWidth(int $adbt_img_width) Return AdbannerType objects filtered by the adbt_img_width column
 * @method     array findByAdbtImgHeight(int $adbt_img_height) Return AdbannerType objects filtered by the adbt_img_height column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseAdbannerTypeQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseAdbannerTypeQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'AdbannerType', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new AdbannerTypeQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    AdbannerTypeQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof AdbannerTypeQuery) {
			return $criteria;
		}
		$query = new AdbannerTypeQuery();
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
	 * @return    AdbannerType|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = AdbannerTypePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(AdbannerTypePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    AdbannerType A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ADBT_ID`, `ADBT_NAME`, `ADBT_IMG_WIDTH`, `ADBT_IMG_HEIGHT` FROM `adbanner_type` WHERE `ADBT_ID` = :p0';
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
			$obj = new AdbannerType();
			$obj->hydrate($row);
			AdbannerTypePeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    AdbannerType|array|mixed the result, formatted by the current formatter
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
	 * @return    AdbannerTypeQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(AdbannerTypePeer::ADBT_ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    AdbannerTypeQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(AdbannerTypePeer::ADBT_ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the adbt_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByAdbtId(1234); // WHERE adbt_id = 1234
	 * $query->filterByAdbtId(array(12, 34)); // WHERE adbt_id IN (12, 34)
	 * $query->filterByAdbtId(array('min' => 12)); // WHERE adbt_id > 12
	 * </code>
	 *
	 * @param     mixed $adbtId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AdbannerTypeQuery The current query, for fluid interface
	 */
	public function filterByAdbtId($adbtId = null, $comparison = null)
	{
		if (is_array($adbtId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(AdbannerTypePeer::ADBT_ID, $adbtId, $comparison);
	}

	/**
	 * Filter the query on the adbt_name column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByAdbtName('fooValue');   // WHERE adbt_name = 'fooValue'
	 * $query->filterByAdbtName('%fooValue%'); // WHERE adbt_name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $adbtName The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AdbannerTypeQuery The current query, for fluid interface
	 */
	public function filterByAdbtName($adbtName = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($adbtName)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $adbtName)) {
				$adbtName = str_replace('*', '%', $adbtName);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(AdbannerTypePeer::ADBT_NAME, $adbtName, $comparison);
	}

	/**
	 * Filter the query on the adbt_img_width column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByAdbtImgWidth(1234); // WHERE adbt_img_width = 1234
	 * $query->filterByAdbtImgWidth(array(12, 34)); // WHERE adbt_img_width IN (12, 34)
	 * $query->filterByAdbtImgWidth(array('min' => 12)); // WHERE adbt_img_width > 12
	 * </code>
	 *
	 * @param     mixed $adbtImgWidth The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AdbannerTypeQuery The current query, for fluid interface
	 */
	public function filterByAdbtImgWidth($adbtImgWidth = null, $comparison = null)
	{
		if (is_array($adbtImgWidth)) {
			$useMinMax = false;
			if (isset($adbtImgWidth['min'])) {
				$this->addUsingAlias(AdbannerTypePeer::ADBT_IMG_WIDTH, $adbtImgWidth['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($adbtImgWidth['max'])) {
				$this->addUsingAlias(AdbannerTypePeer::ADBT_IMG_WIDTH, $adbtImgWidth['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(AdbannerTypePeer::ADBT_IMG_WIDTH, $adbtImgWidth, $comparison);
	}

	/**
	 * Filter the query on the adbt_img_height column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByAdbtImgHeight(1234); // WHERE adbt_img_height = 1234
	 * $query->filterByAdbtImgHeight(array(12, 34)); // WHERE adbt_img_height IN (12, 34)
	 * $query->filterByAdbtImgHeight(array('min' => 12)); // WHERE adbt_img_height > 12
	 * </code>
	 *
	 * @param     mixed $adbtImgHeight The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AdbannerTypeQuery The current query, for fluid interface
	 */
	public function filterByAdbtImgHeight($adbtImgHeight = null, $comparison = null)
	{
		if (is_array($adbtImgHeight)) {
			$useMinMax = false;
			if (isset($adbtImgHeight['min'])) {
				$this->addUsingAlias(AdbannerTypePeer::ADBT_IMG_HEIGHT, $adbtImgHeight['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($adbtImgHeight['max'])) {
				$this->addUsingAlias(AdbannerTypePeer::ADBT_IMG_HEIGHT, $adbtImgHeight['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(AdbannerTypePeer::ADBT_IMG_HEIGHT, $adbtImgHeight, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     AdbannerType $adbannerType Object to remove from the list of results
	 *
	 * @return    AdbannerTypeQuery The current query, for fluid interface
	 */
	public function prune($adbannerType = null)
	{
		if ($adbannerType) {
			$this->addUsingAlias(AdbannerTypePeer::ADBT_ID, $adbannerType->getAdbtId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseAdbannerTypeQuery