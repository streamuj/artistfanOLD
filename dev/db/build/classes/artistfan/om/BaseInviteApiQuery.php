<?php


/**
 * Base class that represents a query for the 'invite_api' table.
 *
 * 
 *
 * @method     InviteApiQuery orderByIaId($order = Criteria::ASC) Order by the ia_id column
 * @method     InviteApiQuery orderByIaUserId($order = Criteria::ASC) Order by the ia_user_id column
 * @method     InviteApiQuery orderByIaEmail($order = Criteria::ASC) Order by the ia_email column
 * @method     InviteApiQuery orderByIaType($order = Criteria::ASC) Order by the ia_type column
 * @method     InviteApiQuery orderByCdate($order = Criteria::ASC) Order by the cdate column
 * @method     InviteApiQuery orderByMdate($order = Criteria::ASC) Order by the mdate column
 *
 * @method     InviteApiQuery groupByIaId() Group by the ia_id column
 * @method     InviteApiQuery groupByIaUserId() Group by the ia_user_id column
 * @method     InviteApiQuery groupByIaEmail() Group by the ia_email column
 * @method     InviteApiQuery groupByIaType() Group by the ia_type column
 * @method     InviteApiQuery groupByCdate() Group by the cdate column
 * @method     InviteApiQuery groupByMdate() Group by the mdate column
 *
 * @method     InviteApiQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     InviteApiQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     InviteApiQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     InviteApi findOne(PropelPDO $con = null) Return the first InviteApi matching the query
 * @method     InviteApi findOneOrCreate(PropelPDO $con = null) Return the first InviteApi matching the query, or a new InviteApi object populated from the query conditions when no match is found
 *
 * @method     InviteApi findOneByIaId(int $ia_id) Return the first InviteApi filtered by the ia_id column
 * @method     InviteApi findOneByIaUserId(int $ia_user_id) Return the first InviteApi filtered by the ia_user_id column
 * @method     InviteApi findOneByIaEmail(string $ia_email) Return the first InviteApi filtered by the ia_email column
 * @method     InviteApi findOneByIaType(string $ia_type) Return the first InviteApi filtered by the ia_type column
 * @method     InviteApi findOneByCdate(int $cdate) Return the first InviteApi filtered by the cdate column
 * @method     InviteApi findOneByMdate(int $mdate) Return the first InviteApi filtered by the mdate column
 *
 * @method     array findByIaId(int $ia_id) Return InviteApi objects filtered by the ia_id column
 * @method     array findByIaUserId(int $ia_user_id) Return InviteApi objects filtered by the ia_user_id column
 * @method     array findByIaEmail(string $ia_email) Return InviteApi objects filtered by the ia_email column
 * @method     array findByIaType(string $ia_type) Return InviteApi objects filtered by the ia_type column
 * @method     array findByCdate(int $cdate) Return InviteApi objects filtered by the cdate column
 * @method     array findByMdate(int $mdate) Return InviteApi objects filtered by the mdate column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseInviteApiQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseInviteApiQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'InviteApi', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new InviteApiQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    InviteApiQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof InviteApiQuery) {
			return $criteria;
		}
		$query = new InviteApiQuery();
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
	 * @return    InviteApi|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = InviteApiPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(InviteApiPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    InviteApi A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `IA_ID`, `IA_USER_ID`, `IA_EMAIL`, `IA_TYPE`, `CDATE`, `MDATE` FROM `invite_api` WHERE `IA_ID` = :p0';
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
			$obj = new InviteApi();
			$obj->hydrate($row);
			InviteApiPeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    InviteApi|array|mixed the result, formatted by the current formatter
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
	 * @return    InviteApiQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(InviteApiPeer::IA_ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    InviteApiQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(InviteApiPeer::IA_ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the ia_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByIaId(1234); // WHERE ia_id = 1234
	 * $query->filterByIaId(array(12, 34)); // WHERE ia_id IN (12, 34)
	 * $query->filterByIaId(array('min' => 12)); // WHERE ia_id > 12
	 * </code>
	 *
	 * @param     mixed $iaId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    InviteApiQuery The current query, for fluid interface
	 */
	public function filterByIaId($iaId = null, $comparison = null)
	{
		if (is_array($iaId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(InviteApiPeer::IA_ID, $iaId, $comparison);
	}

	/**
	 * Filter the query on the ia_user_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByIaUserId(1234); // WHERE ia_user_id = 1234
	 * $query->filterByIaUserId(array(12, 34)); // WHERE ia_user_id IN (12, 34)
	 * $query->filterByIaUserId(array('min' => 12)); // WHERE ia_user_id > 12
	 * </code>
	 *
	 * @param     mixed $iaUserId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    InviteApiQuery The current query, for fluid interface
	 */
	public function filterByIaUserId($iaUserId = null, $comparison = null)
	{
		if (is_array($iaUserId)) {
			$useMinMax = false;
			if (isset($iaUserId['min'])) {
				$this->addUsingAlias(InviteApiPeer::IA_USER_ID, $iaUserId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($iaUserId['max'])) {
				$this->addUsingAlias(InviteApiPeer::IA_USER_ID, $iaUserId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(InviteApiPeer::IA_USER_ID, $iaUserId, $comparison);
	}

	/**
	 * Filter the query on the ia_email column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByIaEmail('fooValue');   // WHERE ia_email = 'fooValue'
	 * $query->filterByIaEmail('%fooValue%'); // WHERE ia_email LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $iaEmail The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    InviteApiQuery The current query, for fluid interface
	 */
	public function filterByIaEmail($iaEmail = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($iaEmail)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $iaEmail)) {
				$iaEmail = str_replace('*', '%', $iaEmail);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(InviteApiPeer::IA_EMAIL, $iaEmail, $comparison);
	}

	/**
	 * Filter the query on the ia_type column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByIaType('fooValue');   // WHERE ia_type = 'fooValue'
	 * $query->filterByIaType('%fooValue%'); // WHERE ia_type LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $iaType The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    InviteApiQuery The current query, for fluid interface
	 */
	public function filterByIaType($iaType = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($iaType)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $iaType)) {
				$iaType = str_replace('*', '%', $iaType);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(InviteApiPeer::IA_TYPE, $iaType, $comparison);
	}

	/**
	 * Filter the query on the cdate column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCdate(1234); // WHERE cdate = 1234
	 * $query->filterByCdate(array(12, 34)); // WHERE cdate IN (12, 34)
	 * $query->filterByCdate(array('min' => 12)); // WHERE cdate > 12
	 * </code>
	 *
	 * @param     mixed $cdate The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    InviteApiQuery The current query, for fluid interface
	 */
	public function filterByCdate($cdate = null, $comparison = null)
	{
		if (is_array($cdate)) {
			$useMinMax = false;
			if (isset($cdate['min'])) {
				$this->addUsingAlias(InviteApiPeer::CDATE, $cdate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($cdate['max'])) {
				$this->addUsingAlias(InviteApiPeer::CDATE, $cdate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(InviteApiPeer::CDATE, $cdate, $comparison);
	}

	/**
	 * Filter the query on the mdate column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByMdate(1234); // WHERE mdate = 1234
	 * $query->filterByMdate(array(12, 34)); // WHERE mdate IN (12, 34)
	 * $query->filterByMdate(array('min' => 12)); // WHERE mdate > 12
	 * </code>
	 *
	 * @param     mixed $mdate The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    InviteApiQuery The current query, for fluid interface
	 */
	public function filterByMdate($mdate = null, $comparison = null)
	{
		if (is_array($mdate)) {
			$useMinMax = false;
			if (isset($mdate['min'])) {
				$this->addUsingAlias(InviteApiPeer::MDATE, $mdate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($mdate['max'])) {
				$this->addUsingAlias(InviteApiPeer::MDATE, $mdate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(InviteApiPeer::MDATE, $mdate, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     InviteApi $inviteApi Object to remove from the list of results
	 *
	 * @return    InviteApiQuery The current query, for fluid interface
	 */
	public function prune($inviteApi = null)
	{
		if ($inviteApi) {
			$this->addUsingAlias(InviteApiPeer::IA_ID, $inviteApi->getIaId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseInviteApiQuery