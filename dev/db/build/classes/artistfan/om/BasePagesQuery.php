<?php


/**
 * Base class that represents a query for the 'pages' table.
 *
 * 
 *
 * @method     PagesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     PagesQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     PagesQuery orderByPagename($order = Criteria::ASC) Order by the pagename column
 * @method     PagesQuery orderBySortid($order = Criteria::ASC) Order by the sortid column
 * @method     PagesQuery orderByStory($order = Criteria::ASC) Order by the story column
 * @method     PagesQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method     PagesQuery orderByPdate($order = Criteria::ASC) Order by the pdate column
 *
 * @method     PagesQuery groupById() Group by the id column
 * @method     PagesQuery groupByTitle() Group by the title column
 * @method     PagesQuery groupByPagename() Group by the pagename column
 * @method     PagesQuery groupBySortid() Group by the sortid column
 * @method     PagesQuery groupByStory() Group by the story column
 * @method     PagesQuery groupByActive() Group by the active column
 * @method     PagesQuery groupByPdate() Group by the pdate column
 *
 * @method     PagesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     PagesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     PagesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     Pages findOne(PropelPDO $con = null) Return the first Pages matching the query
 * @method     Pages findOneOrCreate(PropelPDO $con = null) Return the first Pages matching the query, or a new Pages object populated from the query conditions when no match is found
 *
 * @method     Pages findOneById(int $id) Return the first Pages filtered by the id column
 * @method     Pages findOneByTitle(string $title) Return the first Pages filtered by the title column
 * @method     Pages findOneByPagename(string $pagename) Return the first Pages filtered by the pagename column
 * @method     Pages findOneBySortid(int $sortid) Return the first Pages filtered by the sortid column
 * @method     Pages findOneByStory(string $story) Return the first Pages filtered by the story column
 * @method     Pages findOneByActive(int $active) Return the first Pages filtered by the active column
 * @method     Pages findOneByPdate(int $pdate) Return the first Pages filtered by the pdate column
 *
 * @method     array findById(int $id) Return Pages objects filtered by the id column
 * @method     array findByTitle(string $title) Return Pages objects filtered by the title column
 * @method     array findByPagename(string $pagename) Return Pages objects filtered by the pagename column
 * @method     array findBySortid(int $sortid) Return Pages objects filtered by the sortid column
 * @method     array findByStory(string $story) Return Pages objects filtered by the story column
 * @method     array findByActive(int $active) Return Pages objects filtered by the active column
 * @method     array findByPdate(int $pdate) Return Pages objects filtered by the pdate column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BasePagesQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BasePagesQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'Pages', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new PagesQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    PagesQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof PagesQuery) {
			return $criteria;
		}
		$query = new PagesQuery();
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
	 * @return    Pages|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = PagesPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(PagesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Pages A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `TITLE`, `PAGENAME`, `SORTID`, `STORY`, `ACTIVE`, `PDATE` FROM `pages` WHERE `ID` = :p0';
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
			$obj = new Pages();
			$obj->hydrate($row);
			PagesPeer::addInstanceToPool($obj, (string) $key);
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
	 * @return    Pages|array|mixed the result, formatted by the current formatter
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
	 * @return    PagesQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(PagesPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    PagesQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(PagesPeer::ID, $keys, Criteria::IN);
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
	 * @return    PagesQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(PagesPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the title column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
	 * $query->filterByTitle('%fooValue%'); // WHERE title LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $title The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PagesQuery The current query, for fluid interface
	 */
	public function filterByTitle($title = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($title)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $title)) {
				$title = str_replace('*', '%', $title);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(PagesPeer::TITLE, $title, $comparison);
	}

	/**
	 * Filter the query on the pagename column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPagename('fooValue');   // WHERE pagename = 'fooValue'
	 * $query->filterByPagename('%fooValue%'); // WHERE pagename LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $pagename The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PagesQuery The current query, for fluid interface
	 */
	public function filterByPagename($pagename = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($pagename)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $pagename)) {
				$pagename = str_replace('*', '%', $pagename);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(PagesPeer::PAGENAME, $pagename, $comparison);
	}

	/**
	 * Filter the query on the sortid column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterBySortid(1234); // WHERE sortid = 1234
	 * $query->filterBySortid(array(12, 34)); // WHERE sortid IN (12, 34)
	 * $query->filterBySortid(array('min' => 12)); // WHERE sortid > 12
	 * </code>
	 *
	 * @param     mixed $sortid The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PagesQuery The current query, for fluid interface
	 */
	public function filterBySortid($sortid = null, $comparison = null)
	{
		if (is_array($sortid)) {
			$useMinMax = false;
			if (isset($sortid['min'])) {
				$this->addUsingAlias(PagesPeer::SORTID, $sortid['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($sortid['max'])) {
				$this->addUsingAlias(PagesPeer::SORTID, $sortid['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PagesPeer::SORTID, $sortid, $comparison);
	}

	/**
	 * Filter the query on the story column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByStory('fooValue');   // WHERE story = 'fooValue'
	 * $query->filterByStory('%fooValue%'); // WHERE story LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $story The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PagesQuery The current query, for fluid interface
	 */
	public function filterByStory($story = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($story)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $story)) {
				$story = str_replace('*', '%', $story);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(PagesPeer::STORY, $story, $comparison);
	}

	/**
	 * Filter the query on the active column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByActive(1234); // WHERE active = 1234
	 * $query->filterByActive(array(12, 34)); // WHERE active IN (12, 34)
	 * $query->filterByActive(array('min' => 12)); // WHERE active > 12
	 * </code>
	 *
	 * @param     mixed $active The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PagesQuery The current query, for fluid interface
	 */
	public function filterByActive($active = null, $comparison = null)
	{
		if (is_array($active)) {
			$useMinMax = false;
			if (isset($active['min'])) {
				$this->addUsingAlias(PagesPeer::ACTIVE, $active['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($active['max'])) {
				$this->addUsingAlias(PagesPeer::ACTIVE, $active['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PagesPeer::ACTIVE, $active, $comparison);
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
	 * @return    PagesQuery The current query, for fluid interface
	 */
	public function filterByPdate($pdate = null, $comparison = null)
	{
		if (is_array($pdate)) {
			$useMinMax = false;
			if (isset($pdate['min'])) {
				$this->addUsingAlias(PagesPeer::PDATE, $pdate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($pdate['max'])) {
				$this->addUsingAlias(PagesPeer::PDATE, $pdate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PagesPeer::PDATE, $pdate, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Pages $pages Object to remove from the list of results
	 *
	 * @return    PagesQuery The current query, for fluid interface
	 */
	public function prune($pages = null)
	{
		if ($pages) {
			$this->addUsingAlias(PagesPeer::ID, $pages->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BasePagesQuery