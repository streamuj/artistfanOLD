<?php


/**
 * Base class that represents a query for the 'invitation' table.
 *
 * 
 *
 * @method     InvitationQuery orderByInvId($order = Criteria::ASC) Order by the inv_id column
 * @method     InvitationQuery orderByInvInviter($order = Criteria::ASC) Order by the inv_inviter column
 * @method     InvitationQuery orderByInvInvitee($order = Criteria::ASC) Order by the inv_invitee column
 * @method     InvitationQuery orderByInvName($order = Criteria::ASC) Order by the inv_name column
 * @method     InvitationQuery orderByInvEmail($order = Criteria::ASC) Order by the inv_email column
 * @method     InvitationQuery orderByInvFbid($order = Criteria::ASC) Order by the inv_fbid column
 * @method     InvitationQuery orderByInvStatus($order = Criteria::ASC) Order by the inv_status column
 * @method     InvitationQuery orderByCdate($order = Criteria::ASC) Order by the cdate column
 * @method     InvitationQuery orderByMdate($order = Criteria::ASC) Order by the mdate column
 * @method     InvitationQuery orderByInvTwid($order = Criteria::ASC) Order by the inv_twid column
 *
 * @method     InvitationQuery groupByInvId() Group by the inv_id column
 * @method     InvitationQuery groupByInvInviter() Group by the inv_inviter column
 * @method     InvitationQuery groupByInvInvitee() Group by the inv_invitee column
 * @method     InvitationQuery groupByInvName() Group by the inv_name column
 * @method     InvitationQuery groupByInvEmail() Group by the inv_email column
 * @method     InvitationQuery groupByInvFbid() Group by the inv_fbid column
 * @method     InvitationQuery groupByInvStatus() Group by the inv_status column
 * @method     InvitationQuery groupByCdate() Group by the cdate column
 * @method     InvitationQuery groupByMdate() Group by the mdate column
 * @method     InvitationQuery groupByInvTwid() Group by the inv_twid column
 *
 * @method     InvitationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     InvitationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     InvitationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     Invitation findOne(PropelPDO $con = null) Return the first Invitation matching the query
 * @method     Invitation findOneOrCreate(PropelPDO $con = null) Return the first Invitation matching the query, or a new Invitation object populated from the query conditions when no match is found
 *
 * @method     Invitation findOneByInvId(int $inv_id) Return the first Invitation filtered by the inv_id column
 * @method     Invitation findOneByInvInviter(int $inv_inviter) Return the first Invitation filtered by the inv_inviter column
 * @method     Invitation findOneByInvInvitee(int $inv_invitee) Return the first Invitation filtered by the inv_invitee column
 * @method     Invitation findOneByInvName(string $inv_name) Return the first Invitation filtered by the inv_name column
 * @method     Invitation findOneByInvEmail(string $inv_email) Return the first Invitation filtered by the inv_email column
 * @method     Invitation findOneByInvFbid(string $inv_fbid) Return the first Invitation filtered by the inv_fbid column
 * @method     Invitation findOneByInvStatus(int $inv_status) Return the first Invitation filtered by the inv_status column
 * @method     Invitation findOneByCdate(int $cdate) Return the first Invitation filtered by the cdate column
 * @method     Invitation findOneByMdate(int $mdate) Return the first Invitation filtered by the mdate column
 * @method     Invitation findOneByInvTwid(string $inv_twid) Return the first Invitation filtered by the inv_twid column
 *
 * @method     array findByInvId(int $inv_id) Return Invitation objects filtered by the inv_id column
 * @method     array findByInvInviter(int $inv_inviter) Return Invitation objects filtered by the inv_inviter column
 * @method     array findByInvInvitee(int $inv_invitee) Return Invitation objects filtered by the inv_invitee column
 * @method     array findByInvName(string $inv_name) Return Invitation objects filtered by the inv_name column
 * @method     array findByInvEmail(string $inv_email) Return Invitation objects filtered by the inv_email column
 * @method     array findByInvFbid(string $inv_fbid) Return Invitation objects filtered by the inv_fbid column
 * @method     array findByInvStatus(int $inv_status) Return Invitation objects filtered by the inv_status column
 * @method     array findByCdate(int $cdate) Return Invitation objects filtered by the cdate column
 * @method     array findByMdate(int $mdate) Return Invitation objects filtered by the mdate column
 * @method     array findByInvTwid(string $inv_twid) Return Invitation objects filtered by the inv_twid column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseInvitationQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseInvitationQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'Invitation', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new InvitationQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    InvitationQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof InvitationQuery) {
			return $criteria;
		}
		$query = new InvitationQuery();
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
	 * @return    Invitation|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = InvitationPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(InvitationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Invitation A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `INV_ID`, `INV_INVITER`, `INV_INVITEE`, `INV_NAME`, `INV_EMAIL`, `INV_FBID`, `INV_STATUS`, `CDATE`, `MDATE`, `INV_TWID` FROM `invitation` WHERE `INV_ID` = :p0';
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
			$obj = new Invitation();
			$obj->hydrate($row);
			InvitationPeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    Invitation|array|mixed the result, formatted by the current formatter
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
	 * @return    InvitationQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(InvitationPeer::INV_ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    InvitationQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(InvitationPeer::INV_ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the inv_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByInvId(1234); // WHERE inv_id = 1234
	 * $query->filterByInvId(array(12, 34)); // WHERE inv_id IN (12, 34)
	 * $query->filterByInvId(array('min' => 12)); // WHERE inv_id > 12
	 * </code>
	 *
	 * @param     mixed $invId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    InvitationQuery The current query, for fluid interface
	 */
	public function filterByInvId($invId = null, $comparison = null)
	{
		if (is_array($invId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(InvitationPeer::INV_ID, $invId, $comparison);
	}

	/**
	 * Filter the query on the inv_inviter column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByInvInviter(1234); // WHERE inv_inviter = 1234
	 * $query->filterByInvInviter(array(12, 34)); // WHERE inv_inviter IN (12, 34)
	 * $query->filterByInvInviter(array('min' => 12)); // WHERE inv_inviter > 12
	 * </code>
	 *
	 * @param     mixed $invInviter The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    InvitationQuery The current query, for fluid interface
	 */
	public function filterByInvInviter($invInviter = null, $comparison = null)
	{
		if (is_array($invInviter)) {
			$useMinMax = false;
			if (isset($invInviter['min'])) {
				$this->addUsingAlias(InvitationPeer::INV_INVITER, $invInviter['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($invInviter['max'])) {
				$this->addUsingAlias(InvitationPeer::INV_INVITER, $invInviter['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(InvitationPeer::INV_INVITER, $invInviter, $comparison);
	}

	/**
	 * Filter the query on the inv_invitee column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByInvInvitee(1234); // WHERE inv_invitee = 1234
	 * $query->filterByInvInvitee(array(12, 34)); // WHERE inv_invitee IN (12, 34)
	 * $query->filterByInvInvitee(array('min' => 12)); // WHERE inv_invitee > 12
	 * </code>
	 *
	 * @param     mixed $invInvitee The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    InvitationQuery The current query, for fluid interface
	 */
	public function filterByInvInvitee($invInvitee = null, $comparison = null)
	{
		if (is_array($invInvitee)) {
			$useMinMax = false;
			if (isset($invInvitee['min'])) {
				$this->addUsingAlias(InvitationPeer::INV_INVITEE, $invInvitee['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($invInvitee['max'])) {
				$this->addUsingAlias(InvitationPeer::INV_INVITEE, $invInvitee['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(InvitationPeer::INV_INVITEE, $invInvitee, $comparison);
	}

	/**
	 * Filter the query on the inv_name column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByInvName('fooValue');   // WHERE inv_name = 'fooValue'
	 * $query->filterByInvName('%fooValue%'); // WHERE inv_name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $invName The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    InvitationQuery The current query, for fluid interface
	 */
	public function filterByInvName($invName = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($invName)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $invName)) {
				$invName = str_replace('*', '%', $invName);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(InvitationPeer::INV_NAME, $invName, $comparison);
	}

	/**
	 * Filter the query on the inv_email column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByInvEmail('fooValue');   // WHERE inv_email = 'fooValue'
	 * $query->filterByInvEmail('%fooValue%'); // WHERE inv_email LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $invEmail The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    InvitationQuery The current query, for fluid interface
	 */
	public function filterByInvEmail($invEmail = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($invEmail)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $invEmail)) {
				$invEmail = str_replace('*', '%', $invEmail);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(InvitationPeer::INV_EMAIL, $invEmail, $comparison);
	}

	/**
	 * Filter the query on the inv_fbid column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByInvFbid('fooValue');   // WHERE inv_fbid = 'fooValue'
	 * $query->filterByInvFbid('%fooValue%'); // WHERE inv_fbid LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $invFbid The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    InvitationQuery The current query, for fluid interface
	 */
	public function filterByInvFbid($invFbid = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($invFbid)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $invFbid)) {
				$invFbid = str_replace('*', '%', $invFbid);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(InvitationPeer::INV_FBID, $invFbid, $comparison);
	}

	/**
	 * Filter the query on the inv_status column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByInvStatus(1234); // WHERE inv_status = 1234
	 * $query->filterByInvStatus(array(12, 34)); // WHERE inv_status IN (12, 34)
	 * $query->filterByInvStatus(array('min' => 12)); // WHERE inv_status > 12
	 * </code>
	 *
	 * @param     mixed $invStatus The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    InvitationQuery The current query, for fluid interface
	 */
	public function filterByInvStatus($invStatus = null, $comparison = null)
	{
		if (is_array($invStatus)) {
			$useMinMax = false;
			if (isset($invStatus['min'])) {
				$this->addUsingAlias(InvitationPeer::INV_STATUS, $invStatus['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($invStatus['max'])) {
				$this->addUsingAlias(InvitationPeer::INV_STATUS, $invStatus['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(InvitationPeer::INV_STATUS, $invStatus, $comparison);
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
	 * @return    InvitationQuery The current query, for fluid interface
	 */
	public function filterByCdate($cdate = null, $comparison = null)
	{
		if (is_array($cdate)) {
			$useMinMax = false;
			if (isset($cdate['min'])) {
				$this->addUsingAlias(InvitationPeer::CDATE, $cdate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($cdate['max'])) {
				$this->addUsingAlias(InvitationPeer::CDATE, $cdate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(InvitationPeer::CDATE, $cdate, $comparison);
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
	 * @return    InvitationQuery The current query, for fluid interface
	 */
	public function filterByMdate($mdate = null, $comparison = null)
	{
		if (is_array($mdate)) {
			$useMinMax = false;
			if (isset($mdate['min'])) {
				$this->addUsingAlias(InvitationPeer::MDATE, $mdate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($mdate['max'])) {
				$this->addUsingAlias(InvitationPeer::MDATE, $mdate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(InvitationPeer::MDATE, $mdate, $comparison);
	}

	/**
	 * Filter the query on the inv_twid column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByInvTwid('fooValue');   // WHERE inv_twid = 'fooValue'
	 * $query->filterByInvTwid('%fooValue%'); // WHERE inv_twid LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $invTwid The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    InvitationQuery The current query, for fluid interface
	 */
	public function filterByInvTwid($invTwid = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($invTwid)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $invTwid)) {
				$invTwid = str_replace('*', '%', $invTwid);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(InvitationPeer::INV_TWID, $invTwid, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Invitation $invitation Object to remove from the list of results
	 *
	 * @return    InvitationQuery The current query, for fluid interface
	 */
	public function prune($invitation = null)
	{
		if ($invitation) {
			$this->addUsingAlias(InvitationPeer::INV_ID, $invitation->getInvId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseInvitationQuery